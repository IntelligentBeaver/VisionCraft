<div class="flex justify-center text-left">
    <div class="w-full max-w-6xl py-6 rounded-lg">
        <h4 class="my-8 font-bold text-left">Create a New User</h4>

        <form wire:submit.prevent="createUser">
            <!-- Name Field -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Name</label>
                <input class="w-full mt-1 input input-bordered" type="text" wire:model="name"
                    placeholder="Enter full name">
                @error('name')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Email Field -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input class="w-full mt-1 input input-bordered" type="email" wire:model="email"
                    placeholder="Enter email">
                @error('email')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password Field -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Password</label>
                <input class="w-full mt-1 input input-bordered" type="password" wire:model="password"
                    placeholder="Enter password">
                @error('password')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Role Selection -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Role</label>
                <select class="w-full mt-1 input input-bordered" wire:model="role">
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <!-- Create Button -->
            <div class="mb-4">
                <button class="w-full btn btn-primary" type="submit">Create User</button>
            </div>
        </form>
    </div>
</div>
