<div class="flex justify-center">
    <div class="w-full max-w-3xl rounded-lg p-6">
        <h1 class="my-8 text-center font-bold">Create a New User</h1>

        <form wire:submit.prevent="createUser">
            <!-- Name Field -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Name</label>
                <input class="input input-bordered mt-1 w-full" type="text" wire:model="name"
                    placeholder="Enter full name">
                @error('name')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Email Field -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input class="input input-bordered mt-1 w-full" type="email" wire:model="email"
                    placeholder="Enter email">
                @error('email')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password Field -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Password</label>
                <input class="input input-bordered mt-1 w-full" type="password" wire:model="password"
                    placeholder="Enter password">
                @error('password')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Role Selection -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Role</label>
                <select class="input input-bordered mt-1 w-full" wire:model="role">
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <!-- Create Button -->
            <div class="mb-4">
                <button class="btn btn-primary w-full" type="submit">Create User</button>
            </div>
        </form>
    </div>
</div>
