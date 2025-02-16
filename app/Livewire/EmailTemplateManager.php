<?php

namespace App\Livewire;

use App\Models\EmailTemplate;
use Livewire\Component;

class EmailTemplateManager extends Component
{
    public function render()
    {
        $templates = EmailTemplate::with('salesStage')->get();

        return view('livewire.email-template-manager', compact('templates'));
    }
}
