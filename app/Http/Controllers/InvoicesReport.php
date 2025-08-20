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

        // this case if you want to search about invoice by invoice type
        if($rdio == 1) {
            // if user choose invoice type only and don't choose start_at and end_at
            if($request->type && $request->start_at=='' && $request->end_at=='') {
                $type = $request->type;
                $invoices = invoices::where('status', $type)->get();
                // $invoices = invoices::select('*')->where('status','=',$type)->get();
                return view('reports.invoices_report', compact('type', 'invoices'));
            }
        }
        // this case if you want to search about invoice by invoice number
        else {
            return $request->type;
        }
    }
}