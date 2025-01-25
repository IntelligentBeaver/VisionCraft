@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    <div>
        This is Dashboard Page.

        You are {{ Auth::user()->name }}
        <div class="profile">
            <img class="w-32 h-32 rounded-full" src="{{ asset('storage/' . auth()->user()->image) }}"
                alt="{{ auth()->user()->name }}'s Avatar">
            <p>{{ auth()->user()->name }}</p>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-square btn-primary" type="submit">Logout</button>
        </form>
    </div>
    </div>
@endsection
