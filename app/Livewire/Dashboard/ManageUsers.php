<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;
class ManageUsers extends Component
{
    use WithPagination;

    public $userId, $name, $email, $age, $location, $role;
    public $isEditing = false;
    public $showDeleteModal = false;
    public $userIdToDelete;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'age' => 'nullable|integer|min:18|max:100',
        'location' => 'nullable|string|max:255',
        'role' => 'required|in:user,admin',
    ];

    public function render()
    {
        return view('livewire.dashboard.manage-users', [
            'users' => User::orderBy('created_at', 'desc')->paginate(10)
        ]);
    }

    public function confirmDelete($id)
    {
        $this->userIdToDelete = $id;
        $this->showDeleteModal = true;
    }

    public function deleteUser()
    {
        if ($this->userIdToDelete) {
            User::find($this->userIdToDelete)?->delete();
            session()->flash('success', 'User deleted successfully.');
        }

        $this->closeModal();
    }

    public function closeModal()
    {
        $this->showDeleteModal = false;
        $this->userIdToDelete = null;
    }

    // **Edit User**
    public function edit($id)
    {
        $user = User::findOrFail($id);

        // Populate form fields
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->age = $user->age;
        $this->location = $user->location;
        $this->role = $user->role;

        $this->isEditing = true;
    }

    // **Update User**
    public function updateUser()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->userId,
            'age' => 'nullable|integer|min:18|max:100',
            'location' => 'nullable|string|max:255',
            'role' => 'required|in:user,admin',
        ]);

        $user = User::findOrFail($this->userId);
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'age' => $this->age,
            'location' => $this->location,
            'role' => $this->role,
        ]);

        session()->flash('success', 'User updated successfully.');
        $this->resetFields();
    }

    // **Delete User**
    public function delete($id)
    {
        User::findOrFail($id)->delete();
        session()->flash('success', 'User deleted successfully.');
    }

    // **Reset Form Fields**
    private function resetFields()
    {
        $this->userId = null;
        $this->name = '';
        $this->email = '';
        $this->age = '';
        $this->location = '';
        $this->role = '';
        $this->isEditing = false;
    }
}