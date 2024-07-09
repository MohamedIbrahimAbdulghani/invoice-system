<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $fillable = ["product_name", "description", "section_id"];
    use HasFactory;

    public function section() {
        return $this->belongsTo(Section::class);
    }
}
