@extends('layouts.app')

@section('title', 'Welcome')

@section('content')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <section
        class="flex flex-col items-center justify-between gap-8 px-10 py-12 mx-auto min-h-fit max-w-8xl lg:min-h-screen lg:flex-row">

        <div class="flex flex-col gap-6 hero-text">
            <div class="font-extrabold">
                <h1 class="leading-tight">We help you find</h1>
                <h1 class="leading-tight text-primary">
                    the best solution
                </h1>
            </div>
            <div class="">
                <p class="text-secondaryContent">
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Qui deserunt quis consequuntur facilis soluta
                    ducimus molestias provident. Laborum perspiciatis optio exercitationem magni harum voluptas in
                    consectetur quos minima, enim dolorum.Officia reiciendis debitis numquam labore eos ipsam dolore
                    molestiae quibusdam! Corporis ipsa voluptates impedit fugit tenetur quod id rem sapiente, deserunt fuga
                    molestiae voluptatem accusamus. Corporis ratione aliquid quidem animi.
                </p>
            </div>
            <div class="mt-6">
                <a class="px-5 py-4 font-medium rounded-full btn btn-primary" href="#survey">
                    Take a survey
                </a>
            </div>
        </div>
        <div class="flex items-center justify-center">
            <img class="min-w-[400px] rounded-md shadow-xl" src="{{ asset('images/desktop.png') }}" alt="people"
                height=200 />
        </div>
    </section>
    <!-- Hero Section -->
    {{-- <section class="bg-[#FFF8E7] px-8 py-16 text-center">
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
    </section> --}}

    {{-- <section class="px-8 py-16 bg-white">
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
    </section> --}}

    <!-- Features Section -->
    <section class="bg-[#FFF8E7] px-8 py-24">
        <h2 class="font-bold text-center text-gray-800 mb-14">We offer a complete range of features</h2>
        <div class="grid max-w-6xl grid-cols-1 gap-12 mx-auto md:grid-cols-3">
            <div class="text-center">
                <img class="mx-auto mb-4" src="{{ asset('images/magnifier.png') }}" alt="Job Match">
                <h5 class="mb-2 font-bold">Job Match</h5>
                <p class="text-gray-600">Has natum gubernare. Nam et volutpat vehicula.</p>
            </div>
            <div class="text-center">
                <img class="mx-auto mb-4" src="{{ asset('images/multiple files.png') }}" alt="Resume Optimization">
                <h5 class="mb-2 font-bold">Resume Optimization</h5>
                <p class="text-gray-600">Vic ad sensit soluta nec error reformidans.</p>
            </div>
            <div class="text-center">
                <img class="mx-auto mb-4" src="{{ asset('images/nav.png') }}" alt="Invoice Generator">
                <h5 class="mb-2 font-bold">Invoice Generator</h5>
                <p class="text-gray-600">Pro ex integrite perit nec cum at leos autem.</p>
            </div>
        </div>
    </section>
    <!-- Survey Section -->
    <section class="px-8 py-16 text-center">
        <h2 class="mb-6 font-bold text-primary">Take Our Survey</h2>
        @livewire('question-card')
    </section>

@endsection
