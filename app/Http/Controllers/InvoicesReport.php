<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use App\Models\invoices_details;
use Illuminate\Http\Request;

class InvoicesReport extends Controller
{
    public function index() {
        return view('reports.invoices_report');
    }
    public function Search_invoices(Request $request) {
        $rdio = $request->rdio;
        $type = $request->type;

        // this case if you want to search about invoice by invoice type
        if($rdio == 1) {
            // if user choose invoice type only and don't choose start_at and end_at
            if($type && $request->start_at=='' && $request->end_at=='') {
                if($type == 'كل الفواتير') {
                    $invoices = invoices::all();
                    return view('reports.invoices_report', compact('invoices'));
                }
                $invoices = invoices::where('status', $type)->get();
                return view('reports.invoices_report', compact('type', 'invoices'));
            } else {
                $start_at = date($request->start_at);
                $end_at = date($request->end_at);

                $invoices = invoices::whereBetween('invoice_date', [$start_at, $end_at])->where('status', $type)->get();
                return view('reports.invoices_report', compact('type', 'invoices'));
            }

        }
        // this case if you want to search about invoice by invoice number
        else {
            $invoices = invoices::where('invoice_number', $request->invoice_number)->get();
            return view('reports.invoices_report', compact('invoices'));
        }
    }
}
