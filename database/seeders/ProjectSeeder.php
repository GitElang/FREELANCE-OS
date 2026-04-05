<?php

namespace Database\Seeders; // Harus sama dengan lokasi folder

use Illuminate\Database\Seeder;
use App\Models\Client;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $client = Client::first();

        if ($client) {
            Project::create([
                'client_id' => $client->id,
                'title' => 'Redesign Landing Page',
                'budget' => 5000000,
                'deadline' => now()->addDays(30),
                'status' => 'ongoing'
            ]);
        }
    }
}