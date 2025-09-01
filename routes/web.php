<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\CustomersReport;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvoiceAttachmentsController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\InvoicesDetailsController;
use App\Http\Controllers\InvoicesReport;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\SectionsController;
use App\Http\Controllers\UsersController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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


Route::get('invoices_report', [InvoicesReport::class, 'index']);
Route::post('search_invoices_report', [InvoicesReport::class, 'search_invoices_report'])->name('search_invoices_report');

Route::get('customers_report', [CustomersReport::class, 'index']);
Route::post('search_customers_report', [CustomersReport::class, 'search_customers_report'])->name('search_customers_report');


Route::group(['middleware' => ['auth']], function() {
    // Route::resource('roles','RoleController');
    Route::resource("roles", RolesController::class);
    Route::resource("users", UsersController::class);
    Route::get("users/edit/{id}", [UsersController::class, 'edit'])->name('users.edit');
    // Route::resource('users','UserController');
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





/**************************     this route to make login and validation about status of user when he want make a login in home ************* ************* */

Route::post('/login', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        return back()->withErrors(['email' => 'البريد الإلكتروني أو كلمة المرور غير صحيحة.']);
    }

    if ($user->status !== 'مفعل') {
        return back()->withErrors(['email' => 'حسابك غير مفعل، يرجى التواصل مع الدعم.']);
    }

    Auth::login($user);
    return redirect()->intended('/dashboard');
})->name('login.custom');


/**************************     this route to make login and validation about status of user when he want make a login in home ************* ************* */




Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'check.status'
])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::get('markAsRead/{id}/{invoiceId}', [InvoicesController::class, 'markAsRead'])->name('invoices.markAsRead');



Route::get('markAsReadAll', [InvoicesController::class, 'markAsReadAll'])->name('invoices.markAsReadAll');

Route::get('/{page}', [AdminController::class, "index"]);
