<div class="container mx-auto p-8">
    <h4 class="mb-6 text-left font-semibold">Resume Optimizer</h4>
    <div class="grid grid-cols-1 gap-8 md:grid-cols-2">

        <!-- Left Column: File Upload Section -->
        <div class="flex cursor-pointer flex-col items-center justify-center rounded-lg border-2 border-dashed border-gray-300 p-8 text-center transition-all duration-200 hover:bg-gray-100"
            x-data="{ fileName: @entangle('fileName') }" @click="$refs.fileInput.click()">

            <input class="hidden" type="file" wire:model="resume" x-ref="fileInput"
                @change="fileName = $event.target.files[0]?.name || ''">

            <div class="flex flex-col items-center">
                <!-- Show plus icon and text when no file is selected -->
                <template x-if="!fileName">
                    <div class="flex flex-col items-center">
                        <div class="rounded-full bg-primary p-4 text-white">
                            <svg class="h-10 w-10" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </div>
                        <p class="mt-4 text-gray-500">Click to upload your resume (PDF/DOCX)</p>
                    </div>
                </template>

                <!-- Show PDF/DOCX icon and filename when a file is selected -->
                <template x-if="fileName">
                    <div class="flex flex-col items-center">
                        <div class="rounded-full bg-gray-200 p-4 text-gray-700">
                            <svg class="h-10 w-10" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 4h16v16H4zM8 8h8M8 12h4">
                                </path>
                            </svg>
                        </div>
                        <p class="mt-2 text-sm font-semibold text-gray-700" x-text="fileName"></p>
                    </div>
                </template>
            </div>
        </div>


        <!-- Right Column: File Details and Processing -->
        <div class="rounded-lg border p-6 transition-all duration-300 hover:border-primary hover:shadow-md">
            <h5 class="mb-4 font-bold">Resume Details</h5>

            <!-- Right Column: File Details and Processing -->
            @if ($resume)
                <div class="rounded-lg border border-primary p-4">
                    <p><strong>Filename:</strong> {{ $resume->getClientOriginalName() }}</p>
                    <p><strong>Size:</strong> {{ number_format($resume->getSize() / 1024, 2) }} KB</p>
                    <p><strong>Type:</strong> {{ $resume->getClientOriginalExtension() }}</p>

                    <!-- Buttons: Upload & Remove -->
                    <div class="mt-4 flex space-x-2">
                        <button class="btn btn-primary flex-1" wire:click="uploadResume">
                            Upload & Process
                        </button>
                        <button class="btn btn-error flex-1" wire:click="clearFile">
                            Remove
                        </button>
                    </div>
                </div>
            @else
                <p class="text-gray-500">No file selected.</p>
            @endif

            @if ($downloadUrl)
                <div class="mt-6 rounded border-l-4 border-green-500 bg-green-100 p-4">
                    <p class="text-green-700">Your resume has been processed successfully.</p>
                    <a class="btn btn-success mt-2" href="{{ $downloadUrl }}" download>Download Processed Resume</a>
                </div>
            @endif

            <!-- 🔹 List of Previously Uploaded Resumes -->
            <h5 class="mt-6 font-bold">Your Uploaded Resumes</h5>
            <ul class="mt-4">
                @foreach ($resumes as $resume)
                    <li class="mt-2 flex items-center">
                        <a class="flex-1 truncate text-blue-500 underline"
                            href="{{ asset('storage/' . $resume->filename) }}" target="_blank">
                            {{ basename($resume->filename) }}
                        </a>
                        <button class="ml-2 text-red-500 hover:text-red-700"
                            wire:click="deleteResume({{ $resume->id }})">
                            ❌
                        </button>
                    </li>
                @endforeach
            </ul>
        </div>

    </div>

    <!-- Success & Error Messages -->
    @if (session()->has('message'))
        <div class="alert alert-success mt-4">{{ session('message') }}</div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-error mt-4">{{ session('error') }}</div>
    @endif
</div>
