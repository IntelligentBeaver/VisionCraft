<div class="p-5 mx-4">

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form class="mx-auto space-y-4" wire:submit.prevent="register">
        @csrf
        <div>
            <label class="label">
                <span class="label-text">Name</span>
            </label>
            <input class="w-full input input-bordered" type="text" wire:model.blur="name" placeholder="Your Name" />
            @error('name')
                <span class="text-sm text-error">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label class="label">
                <span class="label-text">Email</span>
            </label>
            <input class="w-full input input-bordered" type="email" wire:model.blur="email"
                placeholder="Your Email" />
            @error('email')
                <span class="text-sm text-error">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label class="label">
                <span class="label-text">Password</span>
            </label>
            <input class="w-full input input-bordered" type="password" wire:model="password"
                placeholder="Your Password" />
            @error('password')
                <span class="text-sm text-error">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label class="label">
                <span class="label-text">Confirm Password</span>
            </label>
            <input class="w-full input input-bordered" type="password" wire:model="password_confirmation"
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
                <input class="w-full input input-bordered" type="number" wire:model.blur="age"
                    placeholder="Your Age" />
                @error('age')
                    <span class="text-sm text-error">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex-1">
                <label class="label">
                    <span class="label-text">Gender</span>
                </label>
                <select class="w-full select select-bordered" wire:model.blur="gender">
                    <option value="">Select Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
                @error('gender')
                    <span class="text-sm text-error">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="py-4">
            <label class="w-full max-w-xs form-control">
                <div class="label">
                    <span class="text-base font-semibold label-text">Upload an Image:</span>
                    <span class="label-text-alt">Avatar</span>
                </div>
                <input class="w-full max-w-xs file-input file-input-bordered file-input-primary" id="image"
                    name="image" type="file" wire:model.blur="image" />
            </label>
        </div>

        @if ($image)
            <div class="mt-4">
                <p>Preview:</p>
                <img class="object-cover w-32 h-32 rounded" src="{{ $image->temporaryUrl() }}" alt="Preview">
            </div>
        @endif

        <div>
            <label class="label">
                <span class="label-text">Location</span>
            </label>
            <input class="w-full input input-bordered" type="text" wire:model.blur="location"
                placeholder="Your Location" />
            @error('location')
                <span class="text-sm text-error">{{ $message }}</span>
            @enderror
        </div>




        <button class="w-full btn btn-primary" type="submit">Register</button>
    </form>
    <div class="py-4">
        <p>Already have an account? <a class="link-secondary" href="{{ route('login') }}">Login</a></p>
    </div>
</div>
