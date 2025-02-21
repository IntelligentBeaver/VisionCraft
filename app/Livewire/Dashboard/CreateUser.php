<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateUser extends Component
{
    public $name, $email, $password, $role = 'user';

    public function createUser()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,user',
        ]);

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => $this->role,
        ]);

        $this->reset();
        session()->flash('success', 'User created successfully!');
    }

    public function render()
    {
        return view('livewire.dashboard.create-user');
    }
}