<?php

namespace App\Livewire\Admin;

use App\Models\AssessmentResponse;
use App\Models\User;
use Livewire\Component;

class Dashboard extends Component
{
    public $totalDSPs;
    public $totalQuestionnaires;

    public function mount()
    {
        $this->totalQuestionnaires = AssessmentResponse::count();
        $this->totalDSPs = User::where('role_id', 2)->count();
    }

    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}
