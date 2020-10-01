<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/images/{path}/{attachment}', function($path, $attachment) {
    $file = sprintf('storage/%s/%s', $path, $attachment);
    if(File::exists($file)) {
        return Image::make($file)->response();
    }
});

Route::get('/', 'HomeController@index')
    ->name('home.index');

Route::group(['middleware' => ["auth"]], function () {

    Route::group(['prefix' => 'orders', 'as' => 'orders.'], function () {
        Route::get('/', 'OrderController@index')
            ->name('index');
        Route::get('/create', 'OrderController@create')
            ->name('create');
        Route::get('/edit/{order}', 'OrderController@edit')
            ->name('edit');
        Route::post('/store', 'OrderController@store')
            ->name('store');
        Route::put('/update/{order}', 'OrderController@update')
            ->name('update');
        Route::delete('/delete/{order}', 'OrderController@destroy')
            ->name('delete');

        Route::get('/datatable', 'OrderController@datatable')
            ->name('datatable');
        Route::get('/products/datatable', 'OrderController@productsDatatable')
            ->name('products-datatable');
    });

    Route::group(['prefix' => 'clients', 'as' => 'clients.'], function () {
        Route::get('/', 'ClientController@index')
            ->name('index');
        Route::get('/create', 'ClientController@create')
            ->name('create');
        Route::post('/store', 'ClientController@store')
            ->name('store');
        Route::delete('/delete/{client}', 'ClientController@destroy')
            ->name('delete');

        Route::get('/datatable', 'ClientController@datatable')
            ->name('datatable');
        Route::post('/sunat', 'ClientController@sunat')
            ->name('sunat');
    });

    Route::group(['prefix' => 'categories', 'as' => 'categories.'], function () {
        Route::get('/', 'CategoryController@index')
            ->name('index');
        Route::get('/create', 'CategoryController@create')
            ->name('create');
        Route::get('/edit/{category}', 'CategoryController@edit')
            ->name('edit');
        Route::post('/store', 'CategoryController@store')
            ->name('store');
        Route::put('/update/{category}', 'CategoryController@update')
            ->name('update');
        Route::delete('/delete/{category}', 'CategoryController@destroy')
            ->name('delete');

        Route::get('/datatable', 'CategoryController@datatable')
            ->name('datatable');
    });

    Route::group(['prefix' => 'products', 'as' => 'products.'], function () {
        Route::get('/', 'ProductController@index')
            ->name('index');
        Route::get('/create', 'ProductController@create')
            ->name('create');
        Route::get('/edit/{product}', 'ProductController@edit')
            ->name('edit');
        Route::post('/store', 'ProductController@store')
            ->name('store');
        Route::put('/update/{product}', 'ProductController@update')
            ->name('update');
        Route::delete('/delete/{product}', 'ProductController@destroy')
            ->name('delete');

        Route::post('/show-product', 'ProductController@showProduct')
            ->name('show-product');
        Route::post('/generate-product-code', 'ProductController@generateProductCode')
            ->name('generate-product-code');
        Route::get('/datatable', 'ProductController@datatable')
            ->name('datatable');
    });

    Route::group(['prefix' => 'invoices', 'as' => 'invoices.'], function () {
        Route::get('/', 'InvoiceController@index')
            ->name('index');
        Route::get('/create/{order}', 'InvoiceController@create')
            ->name('create');
//        Route::get('/edit/{invoice}', 'InvoiceController@edit')
//            ->name('edit');
        Route::post('/store/{order}', 'InvoiceController@store')
            ->name('store');
//        Route::put('/update/{invoice}', 'InvoiceController@update')
//            ->name('update');
//        Route::delete('/delete/{invoice}', 'InvoiceController@destroy')
//            ->name('delete');

        Route::post('/preview/{order}', 'InvoiceController@preview')
            ->name('preview');
        Route::get('/preview-invoice/{order}', 'InvoiceController@previewInvoice')
            ->name('preview-invoice');
        Route::get('/datatable', 'InvoiceController@datatable')
            ->name('datatable');
    });

    Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
        Route::get('/', 'ProfileController@index')
            ->name('index');
        Route::put('/update', 'ProfileController@update')
            ->name('update');
    });

    Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
        Route::get('/', 'UserController@index')
            ->name('index');
        Route::get('/create', 'UserController@create')
            ->name('create');
        Route::get('/edit/{user}', 'UserController@edit')
            ->name('edit');
        Route::post('/store', 'UserController@store')
            ->name('store');
        Route::put('/update/{user}', 'UserController@update')
            ->name('update');
        Route::delete('/delete/{user}', 'UserController@destroy')
            ->name('delete');

        Route::get('/datatable', 'UserController@datatable')
            ->name('datatable');
    });

});
