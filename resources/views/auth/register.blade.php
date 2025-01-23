@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <div class="mx-auto max-w-md">
        <h2 class="text-center text-2xl font-bold">Register</h2>
        <livewire:auth.register />
    </div>
@endsection
