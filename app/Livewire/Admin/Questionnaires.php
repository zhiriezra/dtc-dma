<?php

namespace App\Livewire\Admin;

use App\Models\AssessmentResponse;
use Livewire\Component;
use Livewire\WithPagination;

class Questionnaires extends Component
{
    use WithPagination;

    public $selectedQuestionnaire = null;
    public $showDetails = false;

    public function viewDetails($id)
    {
        $this->selectedQuestionnaire = AssessmentResponse::find($id);
        $this->showDetails = true;
    }

    public function closeDetails()
    {
        $this->showDetails = false;
        $this->selectedQuestionnaire = null;
    }

    public function render()
    {
        $questionnaires = AssessmentResponse::latest()->paginate(10);
        
        return view('livewire.admin.questionnaires', [
            'questionnaires' => $questionnaires
        ]);
    }
} 