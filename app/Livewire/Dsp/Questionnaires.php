<?php

namespace App\Livewire\Dsp;

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
        $this->selectedQuestionnaire = AssessmentResponse::where('user_id', auth()->id())
            ->findOrFail($id);
        $this->showDetails = true;
    }

    public function closeDetails()
    {
        $this->showDetails = false;
        $this->selectedQuestionnaire = null;
    }

    public function render()
    {
        $questionnaires = AssessmentResponse::where('user_id', auth()->id())
            ->latest()
            ->paginate(10);
        
        return view('livewire.dsp.questionnaires', [
            'questionnaires' => $questionnaires
        ]);
    }
}
