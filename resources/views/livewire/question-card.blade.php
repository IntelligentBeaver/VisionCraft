<div class="max-w-4xl px-6 pb-6 mx-auto rounded-lg shadow-md" id="survey">
    @if ($question)
        <!-- Progress Bar -->
        <div class="relative w-full h-3 overflow-hidden bg-gray-200 rounded-lg">
            <div class="absolute top-0 left-0 h-full transition-all duration-300 bg-blue-500"
                style="width: {{ $progress }}%;">
            </div>
        </div>

        <!-- Question Section -->
        <div class="mt-6 space-y-4">
            <h4 class="font-bold">Question {{ $currentQuestionIndex + 1 }}</h4>
            <p class="">{{ is_string($question->question_text) ? $question->question_text : 'Invalid question' }}
            </p>


            <!-- Answer Input -->
            <div>
                @if ($question->question_type == 'text')
                    <input class="w-full input input-bordered" type="text"
                        value="{{ old('answers.' . $currentQuestionIndex, '') }}"
                        wire:model.defer="answers.{{ $currentQuestionIndex }}"
                        wire:key="input-{{ $currentQuestionIndex }}" placeholder="Your answer" />
                @elseif ($question->question_type == 'select')
                    <select class="w-full select select-bordered" wire:model.defer="answers.{{ $currentQuestionIndex }}"
                        wire:key="select-{{ $currentQuestionIndex }}">
                        <option value="" disabled selected>Select an option</option>

                        @foreach ($options as $index => $optionArray)
                            @if ($index == $currentQuestionIndex)
                                <!-- ✅ Show only relevant options -->
                                @foreach ($optionArray as $option)
                                    <option value="{{ $option }}">{{ $option }}</option>
                                @endforeach
                            @endif
                        @endforeach
                    </select>

                @endif

                <!-- Error Message (Animated) -->
                @error("answers.{$currentQuestionIndex}")
                    <p class="mt-2 text-md animate-fadeIn text-error">{{ $message }}</p>
                @enderror
            </div>
            @if (session()->has('message'))
                <p class="mt-4 text-sm text-green-600">{{ session('message') }}</p>
                <a class="btn btn-success text-success-content" href="{{ route('user-dashboard') }}">Go to Dahsboard to
                    view</a>
            @endif

            @if (session()->has('error'))
                <p class="mt-4 text-sm text-red-600">{{ session('error') }}</p>
            @endif
        </div>

        <!-- Navigation Buttons -->
        <div class="flex justify-between mt-6">
            <button
                class="px-4 py-2 text-white transition-all duration-200 bg-gray-500 rounded-lg hover:bg-gray-700 disabled:opacity-50"
                wire:click="previousQuestion" @disabled($currentQuestionIndex == 0)>
                Previous
            </button>

            @if ($currentQuestionIndex < $questions->count() - 1)
                <button
                    class="px-4 py-2 text-white transition-all duration-200 bg-blue-500 rounded-lg hover:bg-blue-700"
                    wire:click="nextQuestion">
                    Next
                </button>
            @else
                <button
                    class="px-4 py-2 text-white transition-all duration-200 bg-green-500 rounded-lg hover:bg-green-700"
                    wire:click="submit">
                    Submit
                </button>
            @endif
        </div>
    @else
        <p class="text-center text-gray-600">No questions available!</p>
    @endif
</div>
