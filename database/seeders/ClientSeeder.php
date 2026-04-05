<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    \App\Models\Client::create([
        'name' => 'Budi Santoso',
        'email' => 'budi@creative.id',
        'company' => 'Creative Digital Agency',
        'status' => 'active'
    ]);

    \App\Models\Client::create([
        'name' => 'Siti Aminah',
        'email' => 'siti@techbox.com',
        'company' => 'TechBox Indonesia',
        'status' => 'active'
    ]);
}
}
