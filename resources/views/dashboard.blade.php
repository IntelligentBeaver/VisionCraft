@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    <div>
        This is Dashboard Page.

        You are {{ Auth::user()->name }}
        <div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-square btn-primary" type="submit">Logout</button>
            </form>
        </div>
    </div>
@endsection
