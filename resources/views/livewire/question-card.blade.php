<div class="max-w-3xl p-6 mx-auto rounded-lg shadow-xl bg-base-100" id="survey">
    @if ($question)
        <!-- ✅ Progress Bar -->
        <div class="relative w-full h-3 overflow-hidden rounded-lg bg-primary/20">
            <div class="absolute top-0 left-0 h-full transition-all duration-300 bg-primary"
                style="width: {{ $progress }}%;">
            </div>
        </div>

        <!-- ✅ Question Section -->
        <div class="mt-6 space-y-4">
            <h2 class="text-lg font-semibold text-primary-content">Question {{ $currentQuestionIndex + 1 }}</h2>
            <p class="text-base-content">
                {{ is_string($question->question_text) ? $question->question_text : 'Invalid question' }}</p>

            <!-- ✅ Answer Input -->
            <div>
                @if ($question->question_type == 'text')
                    <input class="w-full input input-bordered input-primary" type="text"
                        value="{{ old('answers.' . $currentQuestionIndex, '') }}" placeholder="Your answer"
                        wire:model.defer="answers.{{ $currentQuestionIndex }}"
                        wire:key="input-{{ $currentQuestionIndex }}" />
                @elseif ($question->question_type == 'select')
                    <select class="w-full select select-bordered select-primary"
                        wire:model.defer="answers.{{ $currentQuestionIndex }}"
                        wire:key="select-{{ $currentQuestionIndex }}">
                        <option value="" disabled selected>Select an option</option>

                        @foreach ($options as $optionArray)
                            @foreach ($optionArray as $option)
                                <option value="{{ $option }}">{{ $option }}</option>
                            @endforeach
                        @endforeach
                    </select>
                @endif

                <!-- ✅ Error Message -->
                @error("answers.{$currentQuestionIndex}")
                    <p class="mt-2 text-sm animate-fadeIn text-error">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- ✅ Navigation Buttons -->
        <div class="flex justify-between mt-6">
            <button class="btn btn-neutral" wire:click="previousQuestion" @disabled($currentQuestionIndex == 0)>
                « Previous
            </button>

            @if ($currentQuestionIndex < $questions->count() - 1)
                <button class="btn btn-primary" wire:click="nextQuestion">
                    Next »
                </button>
            @else
                <button class="btn btn-success" wire:click="submit">
                    Submit ✔
                </button>
            @endif
        </div>
    @else
        <p class="text-center text-base-content">No questions available!</p>
    @endif
</div>
