<?php

namespace App\Http\Controllers;

use App\Models\Invoices;
use App\Models\invoices_attachments;
use App\Models\invoices_details;
use App\Models\Section;
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
        return view("invoices/invoice");
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sections = Section::all();
        return view("invoices/add_invoice", compact("sections"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // insert data in invoices table in database
        Invoices::create([
            "invoice_number" => $request->invoice_number,
            "invoice_date" => $request->invoice_date,
            "due_date" => $request->due_date,
            "product" => $request->product,
            "section_id" => $request->section_id,
            "amount_collection" => $request->amount_collection,
            "amount_commission" => $request->amount_commission,
            "discount" => $request->discount,
            "value_vat" => $request->value_vat,
            "rate_vat" => $request->rate_vat,
            "total" => $request->total,
            "status" => "غير مدفوعة",
            "value_status" => 2,
            "note" => $request->note,
        ]);

        // insert data in invoices_details table in database
        $invoice_id = Invoices::latest()->first()->id;

            invoices_details::create([
                "invoice_number" => $request->invoice_number,
                "invoice_id" => $invoice_id,
                "product" => $request->product,
                "section" => $request->section_id,
                "status" => "غير مدفوعة",
                "value_status" => 2,
                "note" => $request->note,
                "user" => (Auth::user()->name),
            ]);

        // insert data in invoices_attachments table in database
            if($request->hasFile("image")) {
                $invoice_id = Invoices::latest()->first()->id;
                $image = $request->file("image");
                $file_name = $image->getClientOriginalName();
                $invoice_number = $request->invoice_number;

                $attachments = new invoices_attachments();
                $attachments->file_name = $file_name;
                $attachments->invoice_number = $invoice_number;
                $attachments->created_by = Auth::user()->name;
                $attachments->invoice_id = $invoice_id;
                $attachments->save();

                // move pic
                $imageName = $request->image->getClientOriginalName();
                $request->image->move(public_path("Attachments/" . $invoice_number), $imageName);
            }
            session()->flash("Add", "تم إضافة الفاتورة بنجاح");
            return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function show(Invoices $invoices)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoices $invoices)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoices $invoices)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoices $invoices)
    {
        //
    }
    public function getProductById($id) {
        $products = DB::table("products")->where("section_id", $id)->pluck("product_name", "id");
        return json_encode($products);
    }
}
