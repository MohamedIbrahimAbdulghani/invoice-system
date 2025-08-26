<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
public function index() {
    $invoice_count = invoices::count();
    return view('dashboard', compact('invoice_count'));
}
}
