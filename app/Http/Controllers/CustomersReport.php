<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use App\Models\sections;
use Illuminate\Http\Request;


class CustomersReport extends Controller
{
    public function index() {
        $sections = sections::all();
        return view('reports.customers_report', compact('sections'));
    }

    public function search_customers_report(Request $request) {
        // if user choose section and product only and don't choose start_at and end_at
            if($request->Section && $request->product && $request->start_at=='' && $request->end_at=='') {
                $invoices = invoices::where('id', $request->Section)->where('product', $request->product)->get();
                $sections = sections::all();
                return view('reports.customers_report', compact('sections', 'invoices'));
            } else { // if user choose section and product and choose start_at and end_at
                $start_at = date($request->start_at);
                $end_at = date($request->end_at);

                $invoices = invoices::whereBetween('invoice_date', [$start_at, $end_at])->where('section_id', $request->Section)->get();
                $sections = sections::all();
                return view('reports.customers_report', compact('sections', 'invoices'));
            }
    }
}
