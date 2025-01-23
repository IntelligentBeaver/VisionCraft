<div>
    @if (session('error'))
        <div class="alert-danger alert">{{ session('error') }}</div>
    @endif


    <form class="flex flex-col justify-evenly" wire:submit.prevent="login">
        <div>
            <label class="form-control w-full max-w-md">
                {{-- Upper Label --}}
                <div class="label">
                    <span class="label-text">Email</span>
                </div>

                {{-- The text input field --}}
                <label class="input input-bordered flex items-center gap-2">
                    <svg class="h-4 w-4 opacity-70" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"
                        fill="currentColor">
                        <path
                            d="M2.5 3A1.5 1.5 0 0 0 1 4.5v.793c.026.009.051.02.076.032L7.674 8.51c.206.1.446.1.652 0l6.598-3.185A.755.755 0 0 1 15 5.293V4.5A1.5 1.5 0 0 0 13.5 3h-11Z" />
                        <path
                            d="M15 6.954 8.978 9.86a2.25 2.25 0 0 1-1.956 0L1 6.954V11.5A1.5 1.5 0 0 0 2.5 13h11a1.5 1.5 0 0 0 1.5-1.5V6.954Z" />
                    </svg>
                    <input class='grow' id="email" name="email" type="email" placeholder="abc@gmail.com"
                        wire:model.blur="email">
                </label>
                <div class="label">
                    @error('email')
                        <span class="text-sm text-error">{{ $message }}</span>
                    @enderror
                </div>
            </label>

        </div>
        <div>
            <label class="form-control w-full max-w-md">
                <div class="label">
                    <span class="label-text">Password</span>
                </div>
                <label class="input input-bordered flex items-center gap-2">
                    <svg class="h-4 w-4 opacity-70" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M14 6a4 4 0 0 1-4.899 3.899l-1.955 1.955a.5.5 0 0 1-.353.146H5v1.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-2.293a.5.5 0 0 1 .146-.353l3.955-3.955A4 4 0 1 1 14 6Zm-4-2a.75.75 0 0 0 0 1.5.5.5 0 0 1 .5.5.75.75 0 0 0 1.5 0 2 2 0 0 0-2-2Z"
                            clip-rule="evenodd" />
                    </svg>
                    <input class="grow" id="password" name="password" type="password" wire:model.blur="password"
                        placeholder="abc@123$#">
                </label>
                <div class="label">
                    @error('password')
                        <span class="text-sm text-error">{{ $message }}</span>
                    @enderror
                </div>
            </label>
        </div>
        <div class="max-w-36">
            <label class="label cursor-pointer">
                <span class="label-text">Remember me</span>
                <input class="checkbox checkbox-md" type="checkbox" wire:model.blur="remember" checked="checked" />
            </label>
        </div>
        <button class="btn btn-primary my-3" type="submit">Login</button>
        <div>
            <a class="block" href="{{ route('auth.google') }}">
                <button class="login-with-google-btn" type="button">
                    Sign in with Google
                </button>
            </a>
            <a class="block" href="{{ route('auth.linkedin') }}">
                <button class="login-with-google-btn" type="button">
                    Sign in with LinkedIn
                </button>
            </a>
        </div>
    </form>
</div>
