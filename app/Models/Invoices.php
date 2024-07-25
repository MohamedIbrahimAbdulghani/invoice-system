<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoices extends Model
{
    protected $guarded = [];
    use HasFactory;



    // this function to get data by relationship one to many
    public function section() {
        return $this->belongsTo(Section::class);
    }
}
