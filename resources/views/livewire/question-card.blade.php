<div class="card mx-auto w-full max-w-lg bg-base-100 p-6 shadow-xl">
    @if ($question)
        <!-- Progress Bar -->
        <progress class="progress mx-auto h-3 w-full max-w-7xl" value="{{ $progress }}" max="100"></progress>


        <!-- Question -->
        <div class="card-body">
            <h2 class="card-title text-lg font-bold">Question {{ $currentQuestionIndex + 1 }}</h2>
            <p class="">{{ $question->question_text }}</p>


            <!-- Answer Options -->
            <div class="my-4">
                @if ($types[$currentQuestionIndex] == 'text')
                    <input class="input input-bordered w-full" type="text"
                        wire:model.blur="Question {{ $currentQuestionIndex }}" placeholder="Answer" />
                @elseif ($types[$currentQuestionIndex] == 'select')
                    <select class="select select-bordered w-full" wire:model.change="q1">
                        <option value="Select" disabled selected>Select</option>
                        <option value="Example">Example</option>
                    </select>
                @else
                    <input class="input input-bordered w-full" type="text"
                        wire:model.blur="Question {{ $currentQuestionIndex }}" placeholder="Answer.." />
                @endif
            </div>

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
