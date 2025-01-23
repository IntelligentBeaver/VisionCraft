<div class="mx-auto max-w-lg p-5">

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form class="space-y-4" wire:submit.prevent="register">
        <div>
            <label class="label">
                <span class="label-text">Name</span>
            </label>
            <input class="input input-bordered w-full" type="text" wire:model.blur="name" placeholder="Your Name" />
            @error('name')
                <span class="text-sm text-error">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label class="label">
                <span class="label-text">Email</span>
            </label>
            <input class="input input-bordered w-full" type="email" wire:model.blur="email"
                placeholder="Your Email" />
            @error('email')
                <span class="text-sm text-error">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label class="label">
                <span class="label-text">Password</span>
            </label>
            <input class="input input-bordered w-full" type="password" wire:model="password"
                placeholder="Your Password" />
            @error('password')
                <span class="text-sm text-error">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label class="label">
                <span class="label-text">Confirm Password</span>
            </label>
            <input class="input input-bordered w-full" type="password" wire:model="password_confirmation"
                placeholder="Confirm Your Password" />
            @error('password_confirmation')
                <span class="text-sm text-error">{{ $message }}</span>
            @enderror
        </div>


        <div class="flex justify-between gap-6">
            <div class="flex-1">
                <label class="label">
                    <span class="label-text">Age</span>
                </label>
                <input class="input input-bordered w-full" type="number" wire:model.blur="age"
                    placeholder="Your Age" />
                @error('age')
                    <span class="text-sm text-error">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex-1">
                <label class="label">
                    <span class="label-text">Gender</span>
                </label>
                <select class="select select-bordered w-full" wire:model.blur="gender">
                    <option value="">Select Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
                @error('gender')
                    <span class="text-sm text-error">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div>
            <label class="label">
                <span class="label-text">Location</span>
            </label>
            <input class="input input-bordered w-full" type="text" wire:model.blur="location"
                placeholder="Your Location" />
            @error('location')
                <span class="text-sm text-error">{{ $message }}</span>
            @enderror
        </div>




        <button class="btn btn-primary w-full" type="submit">Register</button>
    </form>
</div>
