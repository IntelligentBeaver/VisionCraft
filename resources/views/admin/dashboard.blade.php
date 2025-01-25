@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="flex h-screen justify-center">
        <div class="w-full max-w-6xl rounded-lg bg-white p-6 shadow">
            <h1 class="text-center text-3xl font-bold">Admin Dashboard</h1>

            <div class="mt-8 grid grid-cols-3 gap-6">
                <div class="rounded-lg bg-blue-500 p-4 text-center text-blue-50">
                    <h2 class="text-xl">Manage Users</h2>
                    <p class="mt-2 text-sm">View, edit, or delete users.</p>
                </div>

                <div class="rounded-lg bg-green-500 p-4 text-center text-green-50">
                    <h2 class="text-xl">Manage Content</h2>
                    <p class="mt-2 text-sm">Add or remove website content.</p>
                </div>

                <div class="rounded-lg bg-red-500 p-4 text-center text-red-50">
                    <h2 class="text-xl">View Reports</h2>
                    <p class="mt-2 text-sm">Track user activity and system reports.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
