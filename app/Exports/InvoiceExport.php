<?php

namespace App\Exports;

use App\Models\invoices;
use Maatwebsite\Excel\Concerns\FromCollection;

class InvoiceExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return invoices::all();
        // return invoices::select('invoice_number', 'status')->get();    //// i use this case when i just want to choose the items i need to show up in the file
    }
}
