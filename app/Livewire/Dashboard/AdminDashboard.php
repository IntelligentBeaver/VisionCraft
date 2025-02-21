<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class AdminDashboard extends Component
{
    public function mount()
    {
        if (Auth::check() && Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }
    }

    public function render()
    {
        return view('livewire.dashboard.admin-dashboard');
    }
}