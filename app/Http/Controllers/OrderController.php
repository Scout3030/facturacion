<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderLine;
use App\Product;
use Carbon\Carbon;
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
        $orderLines = new OrderLine;
        $btnText = __("Registrar orden");
        return view('order.form', compact('order', 'orderLines', 'btnText'));
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

        $total = $cartOrder->reduce(function ($sum, $product) {
            return $sum + $product->price;
        });

        $order = Order::create([
            'client_id' => $request->client_id,
            'total' => $total
        ]);

        foreach ($cartOrder as $product) {
            $orderLines[] = [
                'order_id' =>  $order->id,
                'product_id' => $product->id,
                'qty' => $product->qty,
                'price' => $product->price
            ];
        }

        $this->decreceStock($orderLines);

        OrderLine::insert($orderLines);

        return redirect( route('orders.index') )
            ->with('message', __("Orden registrada correctamente"));
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
        $order->load([
            'client',
            'orderLines.product'
        ])->get();

        $orderLines = collect($order->orderLines);
        $orderLines = $orderLines->each(function ($orderLine, $key) {
            $orderLine->name = $orderLine->product->name;
            $orderLine->id = $orderLine->product->id;
            $orderLine->code = $orderLine->product->code;
        });
        $orderLines = json_encode($orderLines);
        $btnText = __("Actualizar orden");
        return view('order.form', compact('order', 'orderLines', 'btnText'));
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
        $cartOrder = collect(json_decode($request->cart));

        $total = $cartOrder->reduce(function ($sum, $product) {
            return $sum + $product->price;
        });

        $order->fill([
            'total' => $total
        ])->save();

        $order->load([
            'orderLines'
        ])->get();

        $this->increceStock($order->orderLines->toArray());

        $order->orderLines()->delete();

        foreach ($cartOrder as $product) {
            $orderLines[] = [
                'order_id' =>  $order->id,
                'product_id' => $product->id,
                'qty' => $product->qty,
                'price' => $product->price
            ];
        }

        $this->decreceStock($orderLines);

        OrderLine::insert($orderLines);

        return back()->with('message', __("Orden actualizada correctamente"));
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
        $order->load([
            'orderLines'
        ])->get();

        $this->increceStock($order->orderLines->toArray());

        $order->orderLines()->delete();

        $order->delete();
        return redirect( route('categories.index') )
            ->with('message', __("Orden eliminada correctamente"));
    }

    public function datatable () {
        $orders = Order::with(['client'])->get();
        return \DataTables::of($orders)
            ->addColumn('actions', 'order.datatable.actions')
            ->editColumn('total', 'S/ {{$total}}')
            ->editColumn('created_at', function(Order $order) {
                return  $order->created_at->format('d-m-Y H:i');
            })
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

    public function decreceStock($orderLines) {
        foreach ($orderLines as $order){
            $product = Product::whereId($order['product_id'])->first();
            $product->stock = $product->stock - $order['qty'];
            $product->save();
        }
    }

    public function increceStock($orderLines) {
        foreach ($orderLines as $order){
            $product = Product::whereId($order['product_id'])->first();
            $product->stock = $product->stock + $order['qty'];
            $product->save();
        }
    }
}
