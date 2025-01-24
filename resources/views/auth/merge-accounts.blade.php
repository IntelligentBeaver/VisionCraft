@extends('layouts.app')
@section('title', 'Account Merge')

@section('content')
    <div class="container">
        <h1>Account Merge</h1>
        <p>Merge your existing account with a new one to access all your data.</p>
        <form action="{{ route('auth.merge-accounts') }}">
            @csrf
            <div class="form-group">
                <label for="email">Email address:</label>
                {{ Auth::user()->email }}
                @if (request()->has('name'))
                    <p class="font-bold">Name from LinkedIn:</p>
                    <p>{{ request('name') }}</p>
                    <p class="font-bold">Name Present in the database:</p>
                    <p>{{ Auth::user()->name }}</p>
                @endif
            </div>
            <button class="btn btn-primary" type="submit">Merge Account</button>
        </form>
    @endsection
