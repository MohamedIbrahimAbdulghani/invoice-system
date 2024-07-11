<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        User::create([
            'name' => 'Mohamed Ibrahim Abdulghani',
            'email' => 'mohamedibrahimabdulghani@gmail.com',
            'password' => Hash::make('123456789')
        ]);
    }
}
