<?php

namespace App\Http\Controllers;

use App\Models\invoice_attachments;
use App\Models\invoices;
use App\Models\invoices_details;
use App\Models\Products;
use App\Models\sections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("invoices/invoices");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sections = sections::all();
        return view('invoices.create', compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        invoices::create([
            "invoice_number" => $request->invoice_number,
            "invoice_date" => $request->invoice_Date,
            "due_date" => $request->Due_date,
            "section_id" => $request->Section,
            "product" => $request->product,
            "Amount_collection" => $request->Amount_collection,
            "Amount_commission" => $request->Commission,
            "discount" => $request->Discount,
            "rate_vat" => $request->Percentage_Rate_Value_Added,
            "value_vat" => $request->Rate_Value_Added,
            "Total" => $request->Total,
            "Status" => 'غير مدفوعة',
            "value_status" => 2,
            "note" => $request->note,
            "user" => Auth::user()->name,
        ]);

        // this codes to insert the same data to invoice_details table
        $invoice_id = invoices::latest()->first()->id;
        invoices_details::create([
            "invoice_number" => $request->invoice_number,
            "invoice_detail_id" => $invoice_id,
            "product" => $request->product,
            "section" => $request->Section,
            "status" => 'غير مدفوعة',
            "value_status" => 2,
            "note" => $request->note,
            "user" => Auth::user()->name,
        ]);

        if($request->hasFile('file')) {
            $this->validate($request, ['file' => 'required|mimes:pdf|max:10000'], ['file.mimes' => ' pdf خطأ : تم حفظ الفاتورة ولم يتم حفظ المرفق لابد ان يكون ']);
            $invoice_id = invoices::latest()->first()->id;
            $file = $request->file('file');
            $file_name = $file->getClientOriginalName();
            $invoice_number = $request->invoice_number;

            $attachments = new invoice_attachments();
            $attachments->file_name = $file_name;
            $attachments->invoice_number = $invoice_number;
            $attachments->created_by = Auth::user()->name;
            $attachments->invoice_attachment_id = $invoice_id;
            $attachments->save();
            $fileName = $request->file->getClientOriginalName();
            $request->file->move(public_path('Attachments/'.$invoice_number), $fileName);
        }
        session()->flash('Add', 'تم أضافة الفاتورة بنجاح');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function show(invoices $invoices)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function edit(invoices $invoices)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, invoices $invoices)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function destroy(invoices $invoices)
    {
        //
    }

    // this function to make product from select in add invoice
    public function getProducts($id) {
        $products = DB::table('products')->where("section_id", $id)->pluck("product_name", "id");
        return json_encode($products);
    }
}