<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = new Product();
        $btnText = __("Registrar producto");
        return view('product.form', compact('product', 'btnText'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        Product::create([
            'category_id' => $request->category_id,
            'code' => $request->code,
            'name' => $request->name,
            'cost' => $request->cost,
            'price' => $request->price,
            'stock' => $request->stock
        ]);

        return redirect( route('products.index') )
            ->with('message', ['success', __("Producto registrado correctamente")]);
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
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $btnText = __("Actualizar producto");
        return view('product.form', compact('product', 'btnText'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $product->fill([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'cost' => $request->cost,
            'price' => $request->price,
            'stock' => $request->stock
        ])->save();

        return back()->with('message', __("Producto actualizado correctamente"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect( route('products.index') )
            ->with('message', __("Categorìa eliminada correctamente"));
    }

    public function datatable () {
        $products = Product::get();
        return \DataTables::of($products)
            ->addColumn('actions', 'product.datatable.actions')
//            ->editColumn('price', 'S/ {{$price}}')
            ->editColumn('price', function(Product $product) {
                return  $product->formatted_price;
            })
            ->rawColumns(['actions'])
            ->toJson();
    }

    public function showProduct()
    {
        if (request()->ajax())
        {
            $product = Product::select(['id', 'name','price', 'code'])
                ->find(request()->productId);
            $product->qty = 1;
            return response()->json($product, 200);
        }
        abort(401);
    }

    public function generateProductCode()
    {
        if (request()->ajax())
        {
            $product = Product::whereCategoryId(request()->categoryId)
                ->latest()
                ->first();
            $code = ((int) request()->categoryId)*10000000 + $product->id + 1;
            return response()->json($code, 200);
        }
        abort(401);
    }
}
