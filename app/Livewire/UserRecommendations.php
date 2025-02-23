<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Recommendation;
use Illuminate\Support\Facades\Auth;
use App\Models\Survey;


class UserRecommendations extends Component
{
    public $recommendations;

    public function mount()
    {
        // Fetch recommendations for the logged-in user
        // Get the latest survey ID of the logged-in user
        $latestSurvey = Survey::where('user_id', Auth::id())->latest()->first();

        if ($latestSurvey) {
            // Fetch recommendations only for the latest survey
            $this->recommendations = Recommendation::where('user_id', Auth::id())
                ->where('survey_id', $latestSurvey->id)
                ->get();
        } else {
            $this->recommendations = collect(); // Return an empty collection if no survey exists
        }
    }

    public function render()
    {
        return view('livewire.user-recommendations');
    }
}