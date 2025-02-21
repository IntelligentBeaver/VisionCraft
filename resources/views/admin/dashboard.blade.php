@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="max-w-lg mx-auto">
        <h2 class="my-8 font-bold text-center">Admin Dashboard</h2>
        <livewire:dashboard.admin-dashboard />
    </div>
@endsection
