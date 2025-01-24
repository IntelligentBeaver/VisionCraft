<div class="card mx-auto w-full max-w-lg bg-base-100 p-6 shadow-xl">
    @if ($question)
        <!-- Progress Bar -->
        <progress class="progress mx-auto h-3 w-full max-w-7xl" value="{{ $progress }}" max="100"></progress>


        <!-- Question -->
        <div class="card-body">
            <h2 class="card-title text-lg font-bold">Question {{ $currentQuestionIndex + 1 }}</h2>
            <p class="mb-4">{{ $question->question_text }}</p>

            <!-- Navigation Buttons -->
            <div class="card-actions justify-between">
                <button class="btn btn-secondary" wire:click="previousQuestion"
                    {{ $currentQuestionIndex == 0 ? 'disabled' : '' }}>
                    Previous
                </button>
                <button class="btn btn-primary" wire:click="nextQuestion"
                    {{ $currentQuestionIndex == $questions->count() - 1 ? 'disabled' : '' }}>
                    Next
                </button>
            </div>
        </div>
    @else
        <p class="text-center">No questions available!</p>
    @endif
</div>
