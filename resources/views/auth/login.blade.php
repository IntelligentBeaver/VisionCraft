@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="max-w-lg mx-auto">
        <h2 class="my-8 font-bold text-center">Login</h2>
        <livewire:auth.login />
    </div>
@endsection
