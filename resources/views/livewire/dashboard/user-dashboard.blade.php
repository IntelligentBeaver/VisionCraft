<div>
    @if (auth()->user()->role === 'user')
        <div class="profile mb-4">
            <img class="mx-auto mb-2 h-32 w-32 rounded-full" src="{{ asset('storage/' . Auth::user()->image) }}"
                alt="{{ auth()->user()->name }}'s Avatar">
            <p>{{ auth()->user()->name }}</p>
            <p>{{ auth()->user()->role }}</p>
        </div>

        <!-- Button to navigate to profile settings -->
        <div class="mb-4">
            <a class="btn btn-primary w-full" href="{{ route('profile.settings') }}">Go to Profile Settings</a>
        </div>

        <!-- Logout Button -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-square btn-primary w-full" type="submit">Logout</button>
        </form>
    @else
        <p class="text-red-500">Unauthorized Access</p>
    @endif
</div>
