@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
    <!-- Hero Section -->
    <section class="bg-[#FFF8E7] px-8 py-16 text-center">
        <div class="max-w-4xl mx-auto">
            <h1 class="mb-4 text-4xl font-bold text-yellow-600">We help you find the best solution</h1>
            <p class="mb-8 text-gray-700">Et has minim elitr intellegat. Mea aeterno eleifend antiopam ad, nam no suscipit
                quaerendum.</p>
            <button class="px-6 py-3 font-medium text-white bg-yellow-600 rounded-md hover:bg-yellow-500">
                Start Survey
            </button>
        </div>
        <div class="mt-8">
            <img class="w-full max-w-md mx-auto" src="/path/to/hero-image.png" alt="Illustration">
        </div>
    </section>

    <!-- Survey Section -->
    <section class="px-8 py-16 bg-white">
        <h2 class="mb-6 text-3xl font-bold text-center text-yellow-600">Take our survey</h2>
        <div class="mx-auto max-w-4xl rounded-md bg-[#FCEAC7] p-6">
            <div class="mb-4 text-sm font-medium text-gray-700">
                Messaging Banner: Pick any of the options to find out your job!
            </div>
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <p class="font-medium">1. Question text goes here.</p>
                    <div class="flex space-x-2">
                        <button class="px-3 py-1 bg-gray-200 rounded-md">1</button>
                        <button class="px-3 py-1 bg-gray-200 rounded-md">2</button>
                        <button class="px-3 py-1 bg-gray-200 rounded-md">3</button>
                        <button class="px-3 py-1 bg-gray-200 rounded-md">4</button>
                        <button class="px-3 py-1 bg-gray-200 rounded-md">5</button>
                    </div>
                </div>
                <!-- Add more questions as needed -->
            </div>
            <div class="mt-4 text-right">
                <button class="px-6 py-3 font-medium text-white bg-yellow-600 rounded-md hover:bg-yellow-500">
                    Next
                </button>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="bg-[#FFF8E7] px-8 py-16">
        <h2 class="mb-6 text-3xl font-bold text-center text-gray-800">We offer a complete range of features</h2>
        <div class="grid max-w-4xl grid-cols-1 gap-8 mx-auto md:grid-cols-3">
            <div class="text-center">
                <img class="mx-auto mb-4" src="/path/to/job-match-icon.png" alt="Job Match">
                <h3 class="text-lg font-bold">Job Match</h3>
                <p class="text-sm text-gray-600">Has natum gubernare. Nam et volutpat vehicula.</p>
            </div>
            <div class="text-center">
                <img class="mx-auto mb-4" src="/path/to/resume-optimization-icon.png" alt="Resume Optimization">
                <h3 class="text-lg font-bold">Resume Optimization</h3>
                <p class="text-sm text-gray-600">Vic ad sensit soluta nec error reformidans.</p>
            </div>
            <div class="text-center">
                <img class="mx-auto mb-4" src="/path/to/invoice-generator-icon.png" alt="Invoice Generator">
                <h3 class="text-lg font-bold">Invoice Generator</h3>
                <p class="text-sm text-gray-600">Pro ex integrite perit nec cum at leos autem.</p>
            </div>
        </div>
    </section>

@endsection
