<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Operator KKN',
            'email' => 'operatorkkn@abulyatama.ac.id',
            'email_verified_at' => now(),
            'password' => hash::make('admin123'),
            'remember_token' => Str::random(10),
        ]);
    }
}