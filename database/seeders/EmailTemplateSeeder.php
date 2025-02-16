<?php

namespace Database\Seeders;

use App\Models\EmailTemplate;
use App\Models\SalesStage;
use Illuminate\Database\Seeder;

class EmailTemplateSeeder extends Seeder
{
    public function run()
    {
        $stages = SalesStage::all();

        $templates = [
            [
                'sales_stage_id' => $stages->where('name', 'Lead Captured')->first()->id,
                'subject' => 'Welcome to Our Dental Clinic',
                'content' => '<h1>Hello {{name}},</h1><p>Thank you for contacting us about dental implants...</p>',
            ],
            [
                'sales_stage_id' => $stages->where('name', 'Initial Engagement')->first()->id,
                'subject' => 'Let’s Discuss Your Needs',
                'content' => '<h1>Hi {{name}},</h1><p>We’d love to discuss your dental implant needs...</p>',
            ],
            [
                'sales_stage_id' => $stages->where('name', 'Follow-Up & Nurturing')->first()->id,
                'subject' => 'Follow-Up on Your Inquiry',
                'content' => '<h1>Hello {{name}},</h1><p>We noticed you’re still interested in dental implants...</p>',
            ],
            // Add templates for the remaining stages
        ];

        foreach ($templates as $template) {
            EmailTemplate::create($template);
        }
    }
}
