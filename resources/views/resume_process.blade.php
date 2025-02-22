@extends('layouts.app')

@section('title', 'Upload Resume')

@section('content')
    <section class="flex flex-col items-center justify-center min-h-screen px-10 py-12 lg:flex-row gap-12">
        <!-- Search Bar -->
        <div class="w-full max-w-2xl">
            <input type="text" placeholder="Enter Job Title" 
                class="w-full px-6 py-3 text-gray-700 border rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-500" />
        </div>
        
        <!-- Resume Upload & Optimized Resume Display -->
        <div class="flex flex-col lg:flex-row w-full gap-12">
            <!-- Uploaded Resume Display -->
            <div class="flex flex-col items-center w-1/2 p-4 bg-white border rounded-lg shadow-md">
                <h2 class="text-lg font-bold text-gray-700">Uploaded Resume</h2>
                <div class="w-full h-[500px] border rounded-lg bg-gray-100 flex items-center justify-center">
                    <span class="text-gray-500">Resume Preview</span>
                </div>
            </div>
            
            <!-- Optimized Resume Display -->
            <div class="flex flex-col items-center w-1/2 p-4 bg-yellow-50 border rounded-lg shadow-md">
                <h2 class="text-lg font-bold text-yellow-600">Optimized !</h2>
                <div class="w-64 h-80 border rounded-lg bg-white flex items-center justify-center shadow-md">
                    <span class="text-gray-500">Optimized Resume Preview</span>
                </div>
                <div class="flex mt-4 space-x-4">
                    <button class="px-6 py-3 text-white bg-yellow-600 rounded-md shadow-md hover:bg-yellow-500">View</button>
                    <button class="px-6 py-3 text-white bg-yellow-600 rounded-md shadow-md hover:bg-yellow-500">Download</button>
                </div>
            </div>
        </div>
    </section>
@endsection