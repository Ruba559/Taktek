<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;


Route::group(['middleware' => ['auth'] , 'prefix'=>'dashboard'],  function () {


    Route::get('/',[DashboardController::class, 'index'])->name( 'authors');
    Route::get('/platforms',[DashboardController::class, 'platforms'])->name( 'platforms');
});
Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
