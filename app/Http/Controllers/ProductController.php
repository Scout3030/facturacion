<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\ProductRequest;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
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
     * @param ProductRequest $request
     * @return Response
     */
    public function store(ProductRequest $request)
    {
        if($request->hasFile('picture')) {
            $picture = Helper::uploadFile( "picture", 'products');
            $request->merge(['picture' => $picture]);
        }

        Product::create($request->input());

        return redirect( route('products.index') )
            ->with('message', ['success', __("Producto registrado correctamente")]);
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return void
     */
    public function show(Product $product)
    {
        $product->qty = 1;
        return view('product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return Response
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
     * @return Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        if($request->hasFile('picture')) {
            \Storage::delete('profile/' . $request->picture);
            $picture = Helper::uploadFile( "picture", 'products');
            $request->merge(['picture' => $picture]);
        }

        $product->fill($request->input())->save();

        return back()->with('message', ['success', __("Producto actualizado correctamente")]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return Response
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
//            ->addColumn('actions', 'product.datatable.actions')
            ->addColumn('actions', function(Product $product) {
                return '<div class="d-flex">
                            <a href="'. route('products.edit', ['product' => $product]) .'" class="btn btn-rounded btn-warning">'.__("Editar").'</a>
                            <form action="'. route('products.delete', ['product' => $product]) .'" method="POST">
                                <input type="hidden" name="_token" value="'.csrf_token().'">
                                <input type="hidden" name="_method" value="delete">
                                <button class="btn btn-rounded btn-danger" type="submit">'.__('Eliminar').'</button>
                            </form>
                        </div>';
            })
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
            if ($product) $code = ((int) request()->categoryId)*10000000 + $product->id + 1;
            else $code = request()->categoryId*10000000;
            return response()->json($code, 200);
        }
        abort(401);
    }

    public function productList() {
        if (request()->ajax()){
            $products = Product::select(['id', 'name', 'price', 'picture'])->get();
            return response()->json($products, 200);
        }
        abort(401);
    }
}
