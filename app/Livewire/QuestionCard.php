<?php

namespace App\Livewire;

use App\Models\Questions;
use App\Models\Industry;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Response; // Import Response model


class QuestionCard extends Component
{
    public $questions;
    public $currentQuestionIndex = 0;
    public $answers = []; // Store user answers
    public $options = []; // Store dropdown options

    // ✅ Define validation rules
    protected function rules()
    {
        return [
            'answers.*' => 'required|string', // 🔹 Ensure input is always a string
        ];
    }

    // ✅ Custom validation messages
    protected function messages()
    {
        return [
            'answers.*.required' => 'This field is required.',
        ];
    }

    public function mount()
    {
        $this->questions = Questions::all();
        $this->answers = array_fill(0, $this->questions->count(), ''); // 🔹 Initialize as empty strings
        $this->loadOptions();
    }

    public function loadOptions()
    {
        foreach ($this->questions as $index => $question) {
            if ($question->question_type === 'select') {
                $this->options[$index] = Industry::where('category_id', $question->category_id)
                    ->pluck('industry_name') // ✅ Retrieves an array of strings
                    ->toArray();
            } else {
                $this->options[$index] = []; // ✅ Ensure empty array for non-select questions
            }
        }
    }

    public function nextQuestion()
    {
        $this->validateOnly("answers.{$this->currentQuestionIndex}");

        // 🔹 Ensure it's a string before moving forward
        $this->answers[$this->currentQuestionIndex] = strval($this->answers[$this->currentQuestionIndex]);

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

    public function submit()
    {
        $this->validate(); // Ensure all questions are answered

        // Ensure user is authenticated
        $user = Auth::user();
        if (!$user) {
            session()->flash('error', 'You must be logged in to submit answers.');
            return;
        }

        // Store each response in the database
        foreach ($this->answers as $index => $answer) {
            Response::create([
                'user_id' => $user->id,
                'question_id' => $this->questions[$index]->id,
                'survey_id' => $this->questions[$index]->survey_id, // Ensure survey_id is available
                'answer' => $answer,
            ]);
        }

        // Clear answers and reset survey
        $this->reset(['answers', 'currentQuestionIndex']);

        session()->flash('success', 'Your responses have been saved!');
        // dd($this->answers); // Debugging purpose
    }

    public function render()
    {

        return view('livewire.question-card', [
            'question' => $this->questions[$this->currentQuestionIndex] ?? null,
            'progress' => $this->questions->count() > 0
                ? (($this->currentQuestionIndex + 1) / $this->questions->count() * 100)
                : 0,
            'options' => $this->options[$this->currentQuestionIndex] ?? [], // ✅ Pass the full array
        ]);
    }
}