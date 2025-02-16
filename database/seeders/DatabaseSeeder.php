<?php

namespace Database\Seeders;

use App\Models\SalesStage;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $stages = [
            ['name' => 'Lead Captured', 'order' => 1],
            ['name' => 'Initial Engagement', 'order' => 2],
            ['name' => 'Follow-Up & Nurturing', 'order' => 3],
            ['name' => 'Pre-Sale / Booking', 'order' => 4],
            ['name' => 'Offer Stage', 'order' => 5],
            ['name' => 'Sale Closed', 'order' => 6],
            ['name' => 'Lost Opportunity', 'order' => 7],
        ];

        foreach ($stages as $stage) {
            SalesStage::create($stage);
        }

        \App\Models\Lead::create([
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'company' => 'Dental Care Inc.',
            'sales_stage_id' => 1, // Lead Captured
        ]);

        $this->call(EmailTemplateSeeder::class);
    }
}
