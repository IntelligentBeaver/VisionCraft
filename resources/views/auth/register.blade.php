@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <div class="mx-auto max-w-lg">
        <h1 class="my-8 text-center font-bold">Register</h1>
        @livewire('auth.register')
    </div>
@endsection
