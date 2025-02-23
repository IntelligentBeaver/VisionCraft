<div class="mx-auto max-w-3xl rounded-lg bg-white p-6 shadow-xl" id="survey">
    @if ($question)
        <!-- Progress Bar -->
        <div class="relative h-3 w-full overflow-hidden rounded-lg bg-gray-200">
            <div class="absolute left-0 top-0 h-full bg-blue-500 transition-all duration-300"
                style="width: {{ $progress }}%;">
            </div>
        </div>

        <!-- Question Section -->
        <div class="mt-6 space-y-4">
            <h2 class="text-lg font-semibold text-gray-800">Question {{ $currentQuestionIndex + 1 }}</h2>
            <p class="">{{ is_string($question->question_text) ? $question->question_text : 'Invalid question' }}
            </p>


            <!-- Answer Input -->
            <div>
                @if ($question->question_type == 'text')
                    <input class="input input-bordered w-full" type="text"
                        value="{{ old('answers.' . $currentQuestionIndex, '') }}"
                        wire:model.defer="answers.{{ $currentQuestionIndex }}"
                        wire:key="input-{{ $currentQuestionIndex }}" placeholder="Your answer" />
                @elseif ($question->question_type == 'select')
                    <select class="select select-bordered w-full" wire:model.defer="answers.{{ $currentQuestionIndex }}"
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
                    <p class="text-md animate-fadeIn mt-2 text-error">{{ $message }}</p>
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
        <div class="mt-6 flex justify-between">
            <button
                class="rounded-lg bg-gray-500 px-4 py-2 text-white transition-all duration-200 hover:bg-gray-700 disabled:opacity-50"
                wire:click="previousQuestion" @disabled($currentQuestionIndex == 0)>
                Previous
            </button>

            @if ($currentQuestionIndex < $questions->count() - 1)
                <button
                    class="rounded-lg bg-blue-500 px-4 py-2 text-white transition-all duration-200 hover:bg-blue-700"
                    wire:click="nextQuestion">
                    Next
                </button>
            @else
                <button
                    class="rounded-lg bg-green-500 px-4 py-2 text-white transition-all duration-200 hover:bg-green-700"
                    wire:click="submit">
                    Submit
                </button>
            @endif
        </div>
    @else
        <p class="text-center text-gray-600">No questions available!</p>
    @endif
</div>
