<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('order.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $order = new Order();
        $btnText = __("Registrar orden");
        return view('order.form', compact('order', 'btnText'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cartOrder = collect(json_decode($request->cart));
        dd($cartOrder);
        $orderLine = [];

        $order = Order::create([
            'client_id' => $request->name
        ]);

        return redirect( route('categories.index') )
            ->with('message', __("Categorìa registrada correctamente"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Order $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $btnText = __("Actualizar categoría");
        return view('order.form', compact('order', 'btnText'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Order $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $order->fill([
            'name' => $request->name
        ])->save();

        return back()->with('message', __("Categoría actualizada correctamente"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Order $order
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect( route('categories.index') )
            ->with('message', __("Categorìa eliminada correctamente"));
    }

    public function datatable () {
        $categories = Order::get();
        return \DataTables::of($categories)
            ->addColumn('actions', 'order.datatable.actions')
            ->rawColumns(['actions'])
            ->toJson();
    }

    public function productsDatatable () {
        $products = Product::get();
        return \DataTables::of($products)
            ->addColumn('actions', 'order.datatable.products-actions')
            ->editColumn('price', 'S/ {{$price}}')
            ->rawColumns(['actions'])
            ->toJson();
    }
}
