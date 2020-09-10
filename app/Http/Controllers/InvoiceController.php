<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Order;
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
        $data = $request->all();
        session()->put('invoice', $data);
        return redirect( route('invoices.preview-invoice', ['order' => $order->id]));
    }

    public function previewInvoice (Order $order) {
        $data = session('invoice');
        $order->load([
            'client.document',
            'orderLines.product'
        ])->get();
        return view('invoice.preview', compact('data', 'order'));
    }

    public function store (Order $order) {
        $order->load([
            'client'
        ])->get();
        $data = session('invoice');

        $name = $this->generateName($order, $data);
        $invoice = Invoice::whereProofId($data['proof_id'])->latest()->first();
//        dd($name);
        Invoice::create([
            'name' =>  $name,
            'proof_id' => 1,
            'order_id' => $order->id,
            'status' => Invoice::NOSENT,
            'correlative' => $invoice->correlative + 1
        ]);

        try {
            $sunatService = resolve(SunatService::class);
            $sunatService->sendInvoice($data);
        }catch (\Exception $exception){
            Log::debug('Error enviando documento a la sunat');
        }

        return redirect( route('invoices.index'))->with('message', 'Documento emitido correctamente');
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

    public function generateName(Order $order, $data){
        $RRRRRRRRRRR = $order->client->document_number;
        $TT = str_pad($data['proof_id'], 2, "0", STR_PAD_LEFT);
        $invoice = Invoice::whereProofId($data['proof_id'])->latest()->first();
        $CCCCCCCC = $invoice->correlative + 1;
        return $RRRRRRRRRRR.'-'.$TT.'-'.'FAAA'.'-'.$CCCCCCCC;
    }
}
