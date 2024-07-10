<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $fillable = ["product_name", "description", "section_id"];
    use HasFactory;

    // this function to get data by relationship one to many
    public function section() {
        return $this->belongsTo(Section::class);
    }
}
