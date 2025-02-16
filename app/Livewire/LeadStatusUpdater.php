<?php

namespace App\Livewire;

use App\Mail\SalesStageEmail;
use App\Models\EmailTemplate;
use App\Models\Lead;
use App\Models\SalesStage;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class LeadStatusUpdater extends Component
{
    public $leadId;

    public $selectedStage;

    public $selectedStageId;

    public $templateContent;

    public $leads;

    public $salesStages;

    public function mount()
    {
        // Fetch all leads and sales stages
        $this->leads = Lead::all();
        $this->salesStages = SalesStage::orderBy('order')->get();
    }

    public function updatedLeadId($value)
    {
        // Reset selected stage and template content when lead changes
        $this->selectedStage = null;
        $this->templateContent = null;
    }

    public function updateLead($leadId)
    {
        $this->leadId = $leadId;
    }

    public function updateStage($stageId)
    {
        // Fetch the selected stage and corresponding email template
        $this->selectedStage = SalesStage::find($stageId);
        $this->selectedStageId = $this->selectedStage->id;

        $template = EmailTemplate::where('sales_stage_id', $stageId)->first();

        if ($template) {
            // Personalize the template content with lead data
            $lead = Lead::find($this->leadId);
            $this->templateContent = str_replace(
                ['{{name}}', '{{company}}'],
                [$lead->name, $lead->company],
                $template->content
            );
        }
    }

    public function sendEmail()
    {
        // Send the email
        $lead = Lead::find($this->leadId);
        Mail::to($lead->email)->send(new SalesStageEmail($this->templateContent));

        // Log the email in the database
        \App\Models\Email::create([
            'lead_id' => $lead->id,
            'sales_stage_id' => $this->selectedStage->id,
            'content' => $this->templateContent,
            'status' => 'sent',
        ]);

        // Reset the form
        $this->reset(['selectedStage', 'templateContent']);
        session()->flash('message', 'Email sent successfully!');
    }

    public function render()
    {
        return view('livewire.lead-status-updater');
    }
}
