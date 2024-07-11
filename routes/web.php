<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SectionController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


Route::resource("invoices", InvoicesController::class);
Route::get("section/{id}", [InvoicesController::class, "getProductById"]);   // this route to get id Product
Route::resource("sections", SectionController::class);
Route::resource("products", ProductsController::class);

    // Route::get('/index', function () {
    //     return view('index');
    // })->name("dashboard.index");     // this is to don't open index page until make register or login and make authentication
});




// Route::get('/{page}', [AdminController::class, "index"]);
Route::get('/{page}', 'App\Http\Controllers\AdminController@index');
