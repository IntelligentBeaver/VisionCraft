<?php

namespace App\Livewire;

use App\Models\Questions;
use Livewire\Component;

class QuestionCard extends Component
{
    public $questions;
    public $currentQuestionIndex = 0;

    public function mount()
    {
        // Fetch all questions from the database
        $this->questions = Questions::all();
    }

    public function nextQuestion()
    {
        if ($this->currentQuestionIndex < $this->questions->count() - 1) {
            $this->currentQuestionIndex++;
        }
    }

    public function previousQuestion()
    {
        if ($this->currentQuestionIndex > 0) {
            $this->currentQuestionIndex--;
        }
    }

    public function render()
    {
        return view('livewire.question-card', [
        'question' => $this->questions[$this->currentQuestionIndex] ?? null,
        'progress' => $this->questions->count() > 0 
            ? (($this->currentQuestionIndex + 1) / $this->questions->count() * 100) 
            : 0,
    ]);
    }
}