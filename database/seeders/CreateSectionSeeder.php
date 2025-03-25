<?php

namespace Database\Seeders;

use App\Models\Products;
use App\Models\sections;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class CreateSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $section = sections::create([
            'section_name' => 'First Section',
            'description' => 'Description For First Section',
            'created_by' => 'Admin',
            // 'created_by' => Auth::user()->name,
        ]);

        $product = Products::create([
            'product_name' => 'First Section',
            'description' => 'Description For First Section',
            'section_id' => $section->id
        ]);
    }
}