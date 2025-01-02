<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoices extends Model
{
    protected $guarded  = [];
    use HasFactory;

    public function sections() {
        return $this->belongsTo(sections::class, 'section_id');
    }
}