<?php

namespace App\Livewire\Dsp;

use App\Models\AssessmentResponse;
use Livewire\Component;
use Livewire\WithPagination;

class Dashboard extends Component
{
    use WithPagination;

    public function render()
    {
    
        $totalAssessments = AssessmentResponse::where('user_id', auth()->id())->count();

        return view('livewire.dsp.dashboard', [            
            'totalAssessments' => $totalAssessments
        ]);
    }
}
