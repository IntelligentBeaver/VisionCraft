<div class="w-full max-w-3xl p-6 mx-auto shadow-xl card bg-base-100" id="survey">
    @if ($question)
        <!-- Progress Bar -->
        <progress class="w-full h-3 mx-auto progress" value="{{ $progress }}" max="100"></progress>


        <!-- Question -->
        <div class="card-body">
            <h2 class="text-lg font-bold card-title">Question {{ $currentQuestionIndex + 1 }}</h2>
            <p class="">{{ $question->question_text }}</p>


            <!-- Answer Options -->
            <div class="my-4">
                @if ($types[$currentQuestionIndex] == 'text')
                    <input class="w-full input input-bordered" type="text"
                        wire:model.blur="Question {{ $currentQuestionIndex }}" placeholder="Answer" />
                @elseif ($types[$currentQuestionIndex] == 'select')
                    <select class="w-full select select-bordered" wire:model.change="q1">
                        <option value="Select" disabled selected>Select</option>
                        <option value="Example">Example</option>
                    </select>
                @else
                    <input class="w-full input input-bordered" type="text"
                        wire:model.blur="Question {{ $currentQuestionIndex }}" placeholder="Answer.." />
                @endif
            </div>

            <!-- Navigation Buttons -->
            <div class="justify-between card-actions">
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
