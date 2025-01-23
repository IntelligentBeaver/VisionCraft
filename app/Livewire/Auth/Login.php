<?php

namespace App\Livewire\Auth;
use Illuminate\Support\Facades\Auth;

use Livewire\Attributes\Validate;
use Livewire\Component;

class Login extends Component
{
    #[Validate('required|email')]
    public $email='';

    #[Validate('required')]
    public $password='';
    public $remember=false;


    public function login()
    {
        $credentials = $this->validate();

        if (Auth::attempt($credentials, $this->remember)) {
            session()->flash('success', 'Login successful.');
            return redirect()->route('dashboard');
        } else {
            session()->flash('error', 'Invalid credentials.');
        }
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}