<?php

namespace App\Http\Controllers;

use App\Models\invoice_attachments;
use App\Models\invoices;
use App\Models\invoices_details;
use App\Models\sections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class InvoicesDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function show(invoices_details $invoices_details)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invoices = invoices::where("id", $id)->first();
        $invoices_details = invoices_details::all()->where("invoice_detail_id", $id);
        $invoices_attachment = invoice_attachments::all()->where("invoice_attachment_id", $id);
        return  view('invoices.invoices_details', compact('invoices', 'invoices_details', 'invoices_attachment'));
    }


    // this function to show file will uploaded it in invoice_attachment
    public function view_file($invoice_number, $file_name) {
        $file = public_path("Attachments/".$invoice_number.'/'.$file_name);
        return response()->file($file);
    }

    // this function to download file will uploaded it in invoice_attachment
    public function download_file($invoice_number, $file_name) {
        $pathToFile = public_path('Attachments/'.$invoice_number.'/'.$file_name);
        return response()->download($pathToFile);
    }
    public function delete_file() {

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, invoices_details $invoices_details)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $invoices = invoice_attachments::findOrFail($request->id);
        $invoices->delete(); // this is to delete invoice_attachment from database
        Storage::disk('public_uploads')->delete($request->invoice_number.'/'.$request->file_name);  // this is to delete attachment from file or from public folder
        session()->flash('Delete', 'تم حذف المرفق بنجاح');
        return back();
    }
}