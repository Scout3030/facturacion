<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Order;
use App\Services\InvoiceService;
use App\Services\SunatService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules\In;
use function Psy\debug;

class InvoiceController extends Controller
{
    public function index () {
        return view('invoice.index');
    }

    public function create (Order $order) {
        $order->load([
            'client.document',
            'orderLines.product'
        ])->get();
        return view('invoice.form', compact('order'));
    }

    public function preview (Request $request, Order $order) {
        $invoiceService = new InvoiceService();
        $invoiceService->deleteInvoice();
        $invoiceService->addData('requestInvoiceData', $request->all());

        return redirect( route('invoices.preview-invoice', ['order' => $order->id]));
    }

    public function previewInvoice (Order $order) {
        $invoiceService = new InvoiceService();
        $invoiceService->getContent();

        $order->load([
            'client.document',
            'orderLines.product'
        ])->get();

        return view('invoice.preview', compact('invoiceData', 'order'));
    }

    public function store (Order $order) {

        $invoiceService = new InvoiceService();
        $invoiceService = $invoiceService->getContent();

        $invoiceData = $invoiceService['requestInvoiceData'];

        $order->load([
            'client'
        ])->get();

        $lastInvoice = Invoice::whereProofId($invoiceData['proof_id'])
                    ->select('correlative')
                    ->latest()
                    ->first();

        $invoice = Invoice::create([
            'name' =>  '$name',
            'proof_id' => 1,
            'order_id' => $order->id,
            'status' => Invoice::NOSENT,
            'correlative' => $lastInvoice ? $lastInvoice->correlative + 1 : 1
        ]);

        try {

            $sunatService = resolve(SunatService::class);
            $invoiceData = $this->generateInvoiceData($order, $invoiceData);
            $response = $sunatService->sendInvoice($invoiceData);
            $generatedInvoice = $invoiceService['generatedInvoice'];
            $invoiceName = $generatedInvoice->getName();

            if ($response->isSuccess()) {

                /** saving the cdr */
                \Storage::disk('public')->put('invoices'.'/R-'.$invoiceName.'.zip', $response->getCdrZip());

                $cdr = $response->getCdrResponse();
                $code = (int) $cdr->getCode();

                if ($code === 0) {
                    Log::info('FACTURA aceptada ');
                    $status = \App\Invoice::APPROVED;
                } else if ($code >= 4000) {
                    Log::info('FACTURA ACEPTADA CON OBSERVACIONES '.json_encode($cdr->getNotes()));
                    $status = \App\Invoice::OBSERVED;
                } else if ($code >= 2000 && $code <= 3999) {
                    Log::info('FACTURA RECHAZADA '.json_encode($cdr->getNotes()));
                    $status = \App\Invoice::REJECTED;
                } else {
                    /** invalid cdr status */
                    $status = 'Exception';
                }
                Log::info(json_encode($cdr->getDescription()).PHP_EOL);

                $invoice->fill([
                    'name' => $invoiceName,
                    'status' => $status
                ])->save();

                return redirect( route('invoices.index'))->with('message', 'Documento emitido correctamente');
            }

        }catch (\Exception $exception){
            Log::debug('Ocurrió un error al enviar la factura a la SUNAT '.json_encode($response->getError()));
        }

        return redirect( route('invoices.index'))->with('message', 'Error al enviar documento a la SUNAT, intente nuevamente en unos momentos');
    }

    /**
     * Datatable
     */
    public function datatable () {
        $invoices = Invoice::with(['order.client'])->get();
        return \DataTables::of($invoices)
            ->addColumn('actions', 'invoice.datatable.actions')
            ->editColumn('status', function(Invoice $invoice) {
                $statusArray = [
                    Invoice::NOSENT  => __('No enviada'),
                    Invoice::REJECTED  => __('Rechazada'),
                    Invoice::OBSERVED  => __('Observada'),
                    Invoice::APPROVED  => __('Aprobada')
                ];
                return  $statusArray[$invoice->status];
            })
            ->rawColumns(['actions'])
            ->toJson();
    }

    public function generateInvoiceData(Order $order, $invoiceData) {
        dd($invoiceData);
        $order->load([
            'client',
            'currency',
            'orderLines.product'
        ])->get();
        return [
            'documentType' => $invoiceData['proof_id'],
            'client' => [
                'document_number' => '20000000001',
                'title' => $order->client->title
            ],
            'company' => [
                'document_number' => '20123456789',
                'title' => 'GREEN SAC',
                'name' => 'GREEN',
                'address' => [

                ]
            ],
            'sale' => [
                'taxes_amount' => 100.00,
                'taxes_percent' => 18.00,
                'taxes' => 18.00,
                'amount' => 100.00,
                'subtotal' => 118.00,
                'total_amount' => 118.00
            ]
        ];
    }
}
