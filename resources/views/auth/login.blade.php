@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="max-w-md mx-auto">
        <h2 class="text-2xl font-bold text-center">Login</h2>
        <livewire:auth.login />
    </div>
@endsection
