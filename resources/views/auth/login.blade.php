@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="mx-auto max-w-md">
        <h2 class="text-center text-2xl font-bold">Login</h2>
        <livewire:auth.login />
    </div>
@endsection
