<?php

namespace App\Livewire;

use App\Models\Questions;
use App\Models\Industry;
use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Survey;
use App\Models\Response;
use App\Models\Recommendation;

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
        if (!Auth::check()) {
            Session::flash('error', 'You must be logged in to continue.');
            return redirect()->route('login');
        }
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

        // Step 1: Create a new survey for the user
        $survey = Survey::create([
            'user_id' => Auth::id(),
            'survey_questions' => count($this->questions),
        ]);

        // Step 2: Store each response in the responses table
        foreach ($this->questions as $index => $question) {
            Response::create([
                'user_id' => Auth::id(),
                'survey_id' => $survey->id,
                'question_id' => $question->id,
            ]);
        }

        // Step 3: Extract skills, industry, and functional area from the first 3 answers
        $requestData = [
            'skills' => $this->answers[0] ?? '',
            'industry' => $this->answers[1] ?? '',
            'functional_area' => $this->answers[3] ?? '',
        ];

        // Step 4: Send data to Flask API
        $response = Http::post('http://127.0.0.1:5000/recommend', $requestData);
        $recommendations = $response->json()['recommendations'] ?? [];

        // Step 5: Store API response in the recommendations table
        foreach ($recommendations as $recommendation) {
            Recommendation::create([
                'user_id' => Auth::id(),
                'survey_id' => $survey->id,
                'job_title' => $recommendation['Job Title'],
                'industry' => $recommendation['Industry'],
                'functional_area' => $recommendation['Functional Area'],
                'role' => $recommendation['Role'],
                'similarity_score' => $recommendation['Similarity Score'],
            ]);
        }

        // Step 6: Redirect or show success message
        session()->flash('message', 'Survey submitted successfully!');
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