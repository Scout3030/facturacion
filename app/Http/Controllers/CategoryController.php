<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = new Category();
        $btnText = __("Registrar categoría");
        return view('category.form', compact('category', 'btnText'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        Category::create([
            'name' => $request->name
        ]);

        return redirect( route('categories.index') )
            ->with('message', __("Categorìa registrada correctamente"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $btnText = __("Actualizar categoría");
        return view('category.form', compact('category', 'btnText'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $category->fill([
            'name' => $request->name
        ])->save();

        return back()->with('message', __("Categoría actualizada correctamente"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect( route('categories.index') )
            ->with('message', __("Categorìa eliminada correctamente"));
    }

    public function datatable () {
        $categories = Category::get();
        return \DataTables::of($categories)
//            ->addColumn('actions', 'category.datatable.actions')
            ->addColumn('actions', function(Category $category) {
                return '<div class="d-flex">
                            <a href="'. route('categories.edit', ['category' => $category]) .'" class="btn btn-rounded btn-warning">'.__("Editar").'</a>
                            <form action="'. route('categories.delete', ['category' => $category]) .'" method="POST">
                                <input type="hidden" name="_token" value="'.csrf_token().'">
                                <input type="hidden" name="_method" value="delete">
                                <button class="btn btn-rounded btn-danger" type="submit">'.__('Eliminar').'</button>
                            </form>
                        </div>';
            })
            ->rawColumns(['actions'])
            ->toJson();
    }
}
