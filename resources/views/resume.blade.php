@extends('layouts.app')

@section('title', 'Resume Optimization')

@section('content')
<div class="max-w-3xl mx-auto p-8">
    <h1 class="text-3xl font-bold text-yellow-600 mb-6">Resume Optimization</h1>

    <!-- {{-- Step 1: Upload Resume --}} -->
    @if (!isset($filename))
        <form action="{{ route('resume.upload') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md">
            @csrf
            <label class="block mb-4">
                <span class="text-gray-700">Upload Resume</span>
                <input type="file" name="resume" class="mt-2 block w-full border p-2 rounded-md" required>
            </label>
            <button type="submit" class="bg-yellow-600 text-white px-6 py-2 rounded-md hover:bg-yellow-500">Next</button>
        </form>
    @endif

    <!-- {{-- Step 2: Optimize Resume --}} -->
    @if (isset($filename) && !isset($optimizedFilename))
        <div class="mt-6 bg-white p-6 rounded-lg shadow-md">
            <p class="text-gray-700 mb-4">File Uploaded<strong>{{ $filename }}</strong></p>
            <a href="{{ route('resume.optimize', ['filename' => $filename]) }}" class="bg-yellow-600 text-white px-6 py-2 rounded-md hover:bg-yellow-500">
                Optimize Resume
            </a>
        </div>
    @endif

    <!-- {{-- Step 3: Download Optimized Resume --}} -->
    @if (isset($optimizedFilename))
        <div class="mt-6 bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-bold text-yellow-600 mb-4">Optimized Resume</h2>
            <p class="text-gray-700 mb-4">Your Optimized Resume<strong>{{ $optimizedFilename }}</strong></p>
            <div class="flex space-x-4">
                <a href="{{ route('resume.download', ['filename' => $optimizedFilename]) }}" class="bg-yellow-600 text-white px-6 py-2 rounded-md hover:bg-yellow-500">
                    Download
                </a>
                <a href="{{ asset('storage/resumes/'.$optimizedFilename) }}" target="_blank" class="bg-gray-600 text-white px-6 py-2 rounded-md hover:bg-gray-500">
                    View
                </a>
            </div>
        </div>
    @endif
</div>
@endsection
