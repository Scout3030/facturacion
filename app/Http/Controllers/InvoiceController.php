<?php

namespace App\Http\Controllers;

use App\Order;
use App\Services\SunatService;
use Illuminate\Http\Request;

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
//        dd($order->total);
        return view('invoice.form', compact('order'));
    }

    public function store (Request $request) {

        $data = $request->all();
        $sunatService = resolve(SunatService::class);
        $sunatService->sendInvoice($data);
        dd($request->all());
    }
}
