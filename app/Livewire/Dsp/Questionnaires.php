<?php

namespace App\Livewire\Dsp;

use App\Models\AssessmentResponse;
use Livewire\Component;
use Livewire\WithPagination;
use Symfony\Component\HttpFoundation\StreamedResponse;

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

    public function export()
    {
        $filename = 'questionnaires-' . now()->format('Y-m-d') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() {
            $file = fopen('php://output', 'w');
            
            // Add headers
            fputcsv($file, [
                'Business Name',
                'Business Email',
                'State',
                'Score',
                'Maturity Level',
                'Date'
            ]);

            // Add data
            AssessmentResponse::where('user_id', auth()->id())
                ->latest()
                ->chunk(100, function($questionnaires) use ($file) {
                    foreach ($questionnaires as $questionnaire) {
                        fputcsv($file, [
                            $questionnaire->business_name,
                            $questionnaire->business_email,
                            $questionnaire->state,
                            $questionnaire->overall_score . '%',
                            $questionnaire->maturity_level,
                            $questionnaire->created_at->format('M d, Y')
                        ]);
                    }
                });

            fclose($file);
        };

        return new StreamedResponse($callback, 200, $headers);
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
