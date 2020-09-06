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

        Route::get('/datatable', 'ClientController@datatable')
            ->name('datatable');
    });

});
