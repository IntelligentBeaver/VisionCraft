<?php

namespace App\Livewire;

use App\Models\Questions;
use App\Models\Industry;
use Livewire\Component;

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
                // ✅ Fetch industry names for the specific category_id of the question
                $this->options[$index] = Industry::where('category_id', $question->category_id)
                    ->pluck('industry_name') // Get only industry names
                    ->toArray();
            } else {
                $this->options[$index] = []; // Keep empty for non-select questions
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
        $this->validate();

        // 🔹 Convert all answers to strings before submission
        foreach ($this->answers as $key => $answer) {
            $this->answers[$key] = strval($answer);
        }

        // dd($this->answers); // Debugging purpose
    }

    public function render()
    {

        // dd(gettype($this->answers[$this->currentQuestionIndex]), $this->answers[$this->currentQuestionIndex]);
        return view('livewire.question-card', [
            'question' => $this->questions[$this->currentQuestionIndex] ?? null,
            'progress' => $this->questions->count() > 0
                ? (($this->currentQuestionIndex + 1) / $this->questions->count() * 100)
                : 0,
            'options' => $this->options[$this->currentQuestionIndex] ?? [], // ✅ Send correct options
        ]);
    }
}