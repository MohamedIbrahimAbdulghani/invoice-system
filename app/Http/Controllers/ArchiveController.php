<?php

namespace App\Http\Controllers;

use App\Models\invoice_attachments;
use App\Models\invoices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArchiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = invoices::onlyTrashed()->get();
        return view('invoices.invoices_archive', compact('invoices'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $id = $request->invoice_id;
        invoices::withTrashed()->where('id', $id)->restore();
        session()->flash('restore_invoice');
        return redirect('invoices');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->invoice_id;
        $invoices = invoices::withTrashed()->where('id', $id)->first();
        $invoice_attachments = invoice_attachments::where('invoice_attachment_id', $id)->first();

        if(!empty($invoice_attachments->invoice_number)) {
            // Storage::disk('public_uploads')->delete($invoice_attachments->invoice_number . "/" . $invoice_attachments->file_name);  /////  this code if i want delete file inside folder
            Storage::disk('public_uploads')->deleteDirectory($invoice_attachments->invoice_number); ///// this code if i want delete all folder
        }
        $invoices->forceDelete();
        session()->flash('delete_invoice');
        return redirect('invoices_archive');


    }
    

}