<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Survey;
use Illuminate\Support\Facades\Auth;

class UserSurveyHistory extends Component
{
    public $surveyHistory = [];

    public function mount()
    {
        $userId = Auth::id();
        // Fetch all surveys with their recommendations, ordered by latest survey first
        $this->surveyHistory = Survey::where('user_id', $userId)
            ->with(['recommendations'])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function render()
    {
        return view('livewire.user-survey-history');
    }
}