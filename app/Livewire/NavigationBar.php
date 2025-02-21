<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
class NavigationBar extends Component
{
    public $user;
    public $isAuthenticated;


    public function mount()
    {
        $this->user = Auth::user();
        $this->isAuthenticated = Auth::check();
    }

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.navigation-bar');
    }
}