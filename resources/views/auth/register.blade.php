@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <div class="max-w-lg mx-auto">
        <h1 class="my-8 font-bold text-center">Register</h1>
        <livewire:auth.register />
    </div>
@endsection
