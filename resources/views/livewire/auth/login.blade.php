<div class="w-full max-w-6xl p-5 mx-4">

    @if (session('error'))
        <div class="px-8 py-3 mx-auto">
            <div class="alert alert-error">
                <p>{{ session('error') }}</p>
            </div>
        </div>
    @endif
    <form class="flex flex-col mx-auto justify-evenly" wire:submit.prevent="login">
        @csrf
        <div>
            <label class="w-full form-control">
                {{-- Upper Label --}}
                <div class="label">
                    <span class="label-text">Email</span>
                </div>

                {{-- The text input field --}}
                <label class="flex items-center gap-2 input input-bordered">
                    <svg class="w-4 h-4 opacity-70" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"
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
            <label class="w-full form-control">
                <div class="label">
                    <span class="label-text">Password</span>
                </div>
                <label class="flex items-center gap-2 input input-bordered">
                    <svg class="w-4 h-4 opacity-70" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"
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
            <label class="cursor-pointer label">
                <span class="label-text">Remember me</span>
                <input class="checkbox checkbox-md" type="checkbox" wire:model.blur="remember" checked="checked" />
            </label>
        </div>
        <button class="my-2 btn btn-primary" type="submit">Login</button>
        <div class="flex flex-col justify-around gap-4 my-2 md:flex-row">
            <div class="flex-row flex-1">
                <a class="min-w-full bg-white btn" href="{{ route('auth.google') }}" role="button">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                        <path
                            d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"
                            fill="#4285F4" />
                        <path
                            d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
                            fill="#34A853" />
                        <path
                            d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"
                            fill="#FBBC05" />
                        <path
                            d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"
                            fill="#EA4335" />
                        <path d="M1 1h22v22H1z" fill="none" />
                    </svg>
                    Log in with Google
                </a>
            </div>
            <div class="flex-1">
                <a class="btn min-w-full bg-[#0075b4] text-white" href="{{ route('auth.linkedin') }}" role="button">

                    <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 72 72" width="24">
                        <g fill="none" fill-rule="evenodd">
                            <path
                                d="M8,72 L64,72 C68.418278,72 72,68.418278 72,64 L72,8 C72,3.581722 68.418278,-8.11624501e-16 64,0 L8,0 C3.581722,8.11624501e-16 -5.41083001e-16,3.581722 0,8 L0,64 C5.41083001e-16,68.418278 3.581722,72 8,72 Z"
                                fill="#007EBB" />
                            <path
                                d="M62,62 L51.315625,62 L51.315625,43.8021149 C51.315625,38.8127542 49.4197917,36.0245323 45.4707031,36.0245323 C41.1746094,36.0245323 38.9300781,38.9261103 38.9300781,43.8021149 L38.9300781,62 L28.6333333,62 L28.6333333,27.3333333 L38.9300781,27.3333333 L38.9300781,32.0029283 C38.9300781,32.0029283 42.0260417,26.2742151 49.3825521,26.2742151 C56.7356771,26.2742151 62,30.7644705 62,40.051212 L62,62 Z M16.349349,22.7940133 C12.8420573,22.7940133 10,19.9296567 10,16.3970067 C10,12.8643566 12.8420573,10 16.349349,10 C19.8566406,10 22.6970052,12.8643566 22.6970052,16.3970067 C22.6970052,19.9296567 19.8566406,22.7940133 16.349349,22.7940133 Z M11.0325521,62 L21.769401,62 L21.769401,27.3333333 L11.0325521,27.3333333 L11.0325521,62 Z"
                                fill="#FFF" />
                        </g>
                    </svg>
                    Log in with LinkedIn
                </a>
            </div>
        </div>
    </form>
    <div class="py-2">
        <p>Don't have an account? <a class="link-secondary" href="{{ route('register') }}">Register</a></p>
    </div>
</div>
