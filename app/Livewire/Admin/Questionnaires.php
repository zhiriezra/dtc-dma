<?php

namespace App\Livewire\Admin;

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
        $this->selectedQuestionnaire = AssessmentResponse::find($id);
        $this->showDetails = true;
    }

    public function closeDetails()
    {
        $this->showDetails = false;
        $this->selectedQuestionnaire = null;
    }

    public function exportQuestionnaires()
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
                'Respondent Name',
                'Email',
                'State',
                'Overall Score',
                'Maturity Level',
                'Date',
                'Business Sector',
                'Employee Count',
                'Years in Business',
                'Role'
            ]);

            // Add data
            AssessmentResponse::chunk(100, function($questionnaires) use ($file) {
                foreach ($questionnaires as $questionnaire) {
                    fputcsv($file, [
                        $questionnaire->business_name,
                        $questionnaire->respondent_name,
                        $questionnaire->email,
                        $questionnaire->state,
                        $questionnaire->overall_score . '%',
                        $questionnaire->maturity_level,
                        $questionnaire->created_at->format('Y-m-d'),
                        $questionnaire->business_sector,
                        $questionnaire->employee_count,
                        $questionnaire->years_in_business,
                        $questionnaire->role
                    ]);
                }
            });

            fclose($file);
        };

        return new StreamedResponse($callback, 200, $headers);
    }

    public function render()
    {
        $questionnaires = AssessmentResponse::latest()->paginate(10);
        
        return view('livewire.admin.questionnaires', [
            'questionnaires' => $questionnaires
        ]);
    }
} 