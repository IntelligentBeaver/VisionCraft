@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="mx-auto max-w-lg">
        <h2 class="my-8 text-center font-bold">Login</h2>
        @livewire('auth.login')
    </div>
@endsection
