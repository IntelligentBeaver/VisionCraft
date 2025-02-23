<div class="flex justify-center">
    <div class="w-full max-w-6xl pb-6 rounded-lg">
        <h4 class="my-8 font-bold text-left">Manage Users</h4>

        @livewire('flash-message')

        <div class="overflow-x-auto">
            <table class="table w-full border">
                <thead class="bg-base-200">
                    <tr>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Age</th>
                        <th class="px-4 py-2">Location</th>
                        <th class="px-4 py-2">Role</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="hover">
                            <td class="px-4 py-2">{{ $user->name }}</td>
                            <td class="px-4 py-2">{{ $user->email }}</td>
                            <td class="px-4 py-2">{{ $user->age ?? 'N/A' }}</td>
                            <td class="px-4 py-2">{{ $user->location ?? 'N/A' }}</td>
                            <td class="px-4 py-2">
                                <span class="{{ $user->role == 'admin' ? 'badge-primary' : 'badge-secondary' }} badge">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td class="px-4 py-2">
                                <button class="btn btn-warning btn-sm"
                                    wire:click="edit({{ $user->id }})">Edit</button>
                                <button class="btn btn-error btn-sm"
                                    wire:click="confirmDelete({{ $user->id }})">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $users->links() }}
            </div>
        </div>

        <!-- Delete Confirmation Modal (Kept Exactly the Same) -->
        @if ($showDeleteModal)
            <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                <div class="modal modal-open">
                    <div class="modal-box">
                        <h4 class="mb-4 font-bold">Confirm Deletion</h4>
                        <p>Are you sure you want to delete this user?</p>
                        <div class="modal-action">
                            <button class="btn btn-error" wire:click="deleteUser">Yes, Delete</button>
                            <button class="btn btn-secondary" wire:click="closeModal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Edit User Form (Kept the Same Logic, Just Updated to DaisyUI Components) -->
        @if ($isEditing)
            <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                <div class="w-full max-w-lg p-6 bg-white rounded-lg">
                    <h3 class="mb-4 font-bold text-center">Edit User</h3>

                    <form wire:submit.prevent="updateUser">
                        <div class="mb-2">
                            <label class="block">Name</label>
                            <input class="w-full input input-bordered" type="text" wire:model="name">
                            @error('name')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label class="block">Email</label>
                            <input class="w-full input input-bordered" type="email" wire:model="email">
                            @error('email')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label class="block">Age</label>
                            <input class="w-full input input-bordered" type="number" wire:model="age">
                            @error('age')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label class="block">Location</label>
                            <input class="w-full input input-bordered" type="text" wire:model="location">
                            @error('location')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block">Role</label>
                            <select class="w-full select select-bordered" wire:model="role">
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>

                        <div class="flex justify-between">
                            <button class="btn btn-secondary" type="button"
                                wire:click="$set('isEditing', false)">Cancel</button>
                            <button class="btn btn-primary" type="submit">Update User</button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>
</div>
