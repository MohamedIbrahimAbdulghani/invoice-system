<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $fillable = [
        "product_name",
        "section_id",
        "description"
    ];
    use HasFactory;

    public function sections() {
        return $this->belongsTo(sections::class, 'section_id');
    }
}