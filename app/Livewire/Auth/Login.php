<?php

namespace App\Livewire\Auth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use Livewire\Attributes\Validate;
use Livewire\Component;

class Login extends Component
{
    #[Validate('required|email')]
    public $email = '';

    #[Validate('required')]
    public $password = '';
    public $remember = false;


    public function login()
    {
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            session()->flash('success', 'Login successful.');
            return redirect('/');
        } else {
            // Session::flash('error', 'Invalid credentials.');
            session()->flash('error', 'Invalid credentials.');
            $this->reset(['password']);  // Reset password only
        }
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}