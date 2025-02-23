<?php

namespace App\Livewire\Auth;

use Livewire\WithFileUploads;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Livewire\Attributes\Validate;

class Register extends Component
{
    use WithFileUploads;
    #[Validate('required|string|max:255')]
    public $name = '';
    #[Validate('required|email|unique:users,email')]
    public $email = '';
    #[Validate('required|min:8|same:password_confirmation')]
    public $password = '';

    #[Validate('required|min:8')]
    public $password_confirmation = '';

    #[Validate('nullable|integer|min:1')]
    public $age;

    #[Validate('nullable|image|max:8192|mimes:png,jpg,jpeg,webp')]
    public $image;

    #[Validate('nullable|string|max:255')]
    public $location = '';

    #[Validate('nullable|string|max:255')]
    public $skills = '';

    #[Validate('nullable|string|max:255')]
    public $education;
    #[Validate('nullable|string|max:255')]
    public $experience;
    #[Validate('nullable|in:male,female')]
    public $gender;
    #[Validate('nullable|string|max:255')]
    public $interest;

    public function register()
    {
        $this->validate();

        $imagePath = $this->image
            ? $this->image->store('images/avatars', 'public')
            : 'images/avatar/placeholder.jpg';

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'image' => $imagePath,
            'location' => $this->location,
            'skills' => $this->skills,
            'education' => $this->education,
            'experience' => $this->experience,
            'gender' => $this->gender,
            'interest' => $this->interest,
            'role' => 'user',
        ]);

        session()->flash('success', 'Registration successful.');
        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}