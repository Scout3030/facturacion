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

Route::group(['middleware' => ["auth"]], function () {


    Route::get('/', 'HomeController@index')
        ->name('home.index');

    Route::group(['prefix' => 'sell', 'as' => 'sell.'], function () {
        Route::get('/', 'SellController@index')
            ->name('index');
    //    Route::post('/search', 'CourseController@search')->name('search');
    //    Route::get('/{course}', 'CourseController@show')->name('show');
    //    Route::get('/{course}/learn', 'CourseController@learn')
    //        ->name('learn')->middleware("can_access_to_course");
    //
    //    Route::get('/{course}/review', 'CourseController@createReview')
    //        ->name('reviews.create');
    //    Route::post('/{course}/review', 'CourseController@storeReview')
    //        ->name('reviews.store');
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

        Route::get('/datatable', 'ProductController@datatable')
            ->name('datatable');
    });

});
