<?php

namespace App\Http\Controllers;

use App\Exports\InvoiceExport;
use App\Mail\AddInvoice as MailAddInvoice;
use App\Mail\AddInvoiceTesting;
use App\Models\invoice_attachments;
use App\Models\invoices;
use App\Models\invoices_details;
use App\Models\Products;
use App\Models\sections;
use App\Models\User;
use App\Notifications\AddInvoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = invoices::all();
        return view("invoices/invoices", compact("invoices"));
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
            "total" => $request->total,
            "status" => 'غير مدفوعة',
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


        // this codes to insert the same data to invoice_attachment table
        if($request->hasFile('file')) {
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

            $imageName = $request->file->getClientOriginalName();
            $request->file->move(public_path('Attachments/' . $invoice_number), $imageName);
        }

        // this code to send mail in mailtrap website
        // $user = User::first();
        // Notification::send($user, new AddInvoice($invoice_id));
    
        session()->flash('Add', 'تم أضافة الفاتورة بنجاح');
        return back();
    }

    /**

     * Display the specified resource.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return view('invoices.status_update');
        $invoices = invoices::where('id', $id)->first();
        return view('invoices.status_update', compact('invoices'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invoices = invoices::where("id", $id)->first();
        $sections = sections::all();
        return  view('invoices.edit_invoice', compact('invoices', 'sections'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $invoice_id = $request->invoice_id;
        $invoices = invoices::findOrFail($invoice_id);
        $invoices->update([
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
            "total" => $request->total,
            "note" => $request->note,
            // "user" => Auth::user()->name,
        ]);

        // this code to update invoice_detail when make update in invoice table
        $details = invoices_details::where("invoice_detail_id", $invoice_id)->first();
        $details->invoice_number = $request->invoice_number;
        $details->section = $request->Section;
        $details->product = $request->product;
        $details->note = $request->note;
        // $details->user = Auth::user()->name;
        $details->update();

        // this code to update invoice_attachment when make update in invoice table
        $attachment = invoice_attachments::where("invoice_attachment_id", $invoice_id)->first();
        $attachment->invoice_number = $request->invoice_number;
        $attachment->update();

        session()->flash('Edit', 'تم تعديل الفاتورة بنجاح');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function destroy(invoices $invoices, Request $request)
    {
        $id = $request->invoice_id;
        $invoices = invoices::where('id', $id)->first();
        $invoice_attachments = invoice_attachments::where('invoice_attachment_id', $id)->first();

        if(!empty($invoice_attachments->invoice_number)) {
            // Storage::disk('public_uploads')->delete($invoice_attachments->invoice_number . "/" . $invoice_attachments->file_name);  /////  this code if i want delete file inside folder
            Storage::disk('public_uploads')->deleteDirectory($invoice_attachments->invoice_number); ///// this code if i want delete all folder
        }
        $invoices->forceDelete();
        session()->flash('delete_invoice');
        return redirect('invoices');

    }

    // this function to make product from select in add invoice
    public function getProducts($id) {
        $products = DB::table('products')->where("section_id", $id)->pluck("product_name", "id");
        return json_encode($products);
    }
    
    public function status_show(Request $request, $id) {
        $sections = sections::all();
        $invoices = invoices::where('id', $id)->first();
        return view('invoices.status_update', compact('invoices', 'sections'));
    }
    public function status_update(Request $request, $id) {
        $invoices = invoices::findOrFail($id);
        if($request->status === 'مدفوعة') {
            $invoices->update([
                'value_status' => 1,
                'status' => $request->status,
                'payment_date' => $request->payment_date
            ]);
            invoices_details::create([
                'invoice_number'=>$request->invoice_number,
                'invoice_detail_id'=>$request->invoice_id,
                'product'=>$request->product,
                'section'=>$request->section,
                'status'=>$request->status,
                'value_status'=> 1,
                'payment_date'=>$request->payment_date,
                'note'=>$request->note,
                'user'=>Auth::user()->name,
            ]);
        } else {
            $invoices->update([
                'value_status' => 3,
                'status' => $request->status,
                'payment_date' => $request->payment_date
            ]);
            invoices_details::create([
                'invoice_number'=>$request->invoice_number,
                'invoice_detail_id'=>$request->invoice_id,
                'product'=>$request->product,
                'section'=>$request->section,
                'status'=>$request->status,
                'value_status'=> 3,
                'payment_date'=>$request->payment_date,
                'note'=>$request->note,
                'user'=>Auth::user()->name,
            ]);
        }
        session()->flash('update_invoice');
        return redirect('invoices');
        // return $request;
    }
    public function invoices_paid() {
        $invoices = invoices::where('value_status', 1)->get();
        return view('invoices.invoices_paid', compact('invoices'));
    }
    public function invoices_unpaid() {
        $invoices = invoices::where('value_status', 2)->get();
        return view('invoices.invoices_unpaid', compact('invoices'));
    }
    public function invoices_partail() {
        $invoices = invoices::where('value_status', 3)->get();
        return view('invoices.invoices_partail', compact('invoices'));
    }
    
    // this function made to use softDelete and archive invoices
    public function invoices_archive(Request $request) {
        $id = $request->invoice_id;
        $invoices = invoices::where('id', $id)->first();
        // i used delete() function because i want delete this invoice from table but i want make copy in database (soft delete)
        $invoices->delete();
        session()->flash('archive_invoice');
        return redirect('invoices_archive');
    }
    // this function to print invoice
    public function print_invoice(Request $request, $id) {
        // $invoice = invoices::where('id', $id)->first();
        $invoice = invoices::findOrFail($id);
        return view('invoices.print_invoice', compact('invoice'));
    }
    // this function to export invoice in excel sheet
    public function export() {
        return Excel::download(new InvoiceExport, 'Invoices.xlsx');
    }
}