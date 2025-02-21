@extends('layouts.app')

@section('title', 'Upload Resume')

@section('content')
    <section class="flex flex-col items-center justify-center min-h-screen px-10 py-12 lg:flex-row gap-12">
        <!-- Search Bar -->
        <div class="w-full max-w-2xl">
            <input type="text" placeholder="Enter Job Title" 
                class="w-full px-6 py-3 text-gray-700 border rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-500" />
        </div>
        
        <!-- Frame and File Upload Section -->
        <div class="flex flex-col items-center justify-center w-full gap-12 lg:flex-row">
            <!-- File Upload Frame -->
            <div class="flex flex-col items-center justify-center w-80 h-[500px] bg-gray-100 rounded-lg shadow-md">
                <button class="w-10 h-10 text-gray-500 border border-gray-400 rounded-full flex items-center justify-center">
                    +
                </button>
            </div>

            <!-- File Upload Button -->
            <div class="flex flex-col items-center">
                <label class="text-lg font-bold text-yellow-600">Choose File</label>
                <button class="flex items-center justify-center px-6 py-3 mt-2 text-white bg-yellow-600 rounded-md shadow-md hover:bg-yellow-500">
                    +
                </button>
            </div>
        </div>

        <!-- Next Button -->
        <div class="absolute bottom-12 right-12">
            <button class="px-6 py-3 text-white bg-yellow-600 rounded-md shadow-md hover:bg-yellow-500">
                Next
            </button>
        </div>
    </section>
@endsection