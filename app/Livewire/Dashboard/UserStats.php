<?php

namespace App\Livewire\Dashboard;

use App\Livewire\Concerns\AuthorizesAdmin;
use Livewire\Component;
use App\Models\User;

class UserStats extends Component
{
    use AuthorizesAdmin;

    public $totalUsers;
    public $totalAdmins;
    public $totalRegularUsers;

    public function mount()
    {
        $this->totalUsers = User::count();
        $this->totalAdmins = User::where('role', 'admin')->count();
        $this->totalRegularUsers = User::where('role', 'user')->count();
    }

    public function render()
    {
        return view('livewire.dashboard.user-stats');
    }
}