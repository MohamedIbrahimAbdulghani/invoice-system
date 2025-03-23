<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\InvoiceAttachmentsController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\InvoicesDetailsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SectionsController;
use App\Http\Controllers\UserController;
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
    // return view('auth.login');
});


Route::get("invoices_paid", [InvoicesController::class, 'invoices_paid']);
Route::get("invoices_unpaid", [InvoicesController::class, 'invoices_unpaid']);
Route::get("invoices_partail", [InvoicesController::class, 'invoices_partail']);

Route::resource('invoices', InvoicesController::class);

Route::get("export", [InvoicesController::class, 'export'])->name('invoices.export');

Route::resource("sections", SectionsController::class);
Route::resource("products", ProductsController::class);
Route::resource("invoice_attachment", InvoiceAttachmentsController::class);
// Route::post("invoice_archive", [ArchiveController::class, 'destroy'])->name('invoices_archive.destroy');
Route::resource('invoices_archive', ArchiveController::class);
Route::get("section/{id}", [InvoicesController::class, "getProducts"]);
Route::get('/{page}', [AdminController::class, "index"]);

Route::get("invoices_details/{id}", [InvoicesDetailsController::class, 'edit']);
Route::get("edit_invoice/{id}", [InvoicesController::class, 'edit']);
Route::get("status_show/{id}", [InvoicesController::class, 'show']);
Route::get("status_show/{id}", [InvoicesController::class, 'status_show']);
Route::get("print_invoice/{id}", [InvoicesController::class, 'print_invoice']);

Route::post("invoices_archive", [InvoicesController::class, 'invoices_archive'])->name('invoices.invoices_archive');

Route::post("status_update/{id}", [InvoicesController::class, 'status_update'])->name('invoices.status_update');
Route::get("view_file/{invoice_number}/{file_name}", [InvoicesDetailsController::class, 'view_file']);
Route::get("download_file/{invoice_number}/{file_name}", [InvoicesDetailsController::class, 'download_file']);
Route::post("delete_file", [InvoicesDetailsController::class, 'destroy'])->name('delete_file');
Route::resource("invoices_details", InvoicesDetailsController::class);
Route::resource("invoices_attachments", InvoiceAttachmentsController::class);



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});