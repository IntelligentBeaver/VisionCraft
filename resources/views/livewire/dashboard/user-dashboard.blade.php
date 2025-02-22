<div>
    @if (auth()->user()->role === 'user')
        <div class="mb-4 profile">
            <img class="w-32 h-32 mx-auto mb-2 rounded-full" src="{{ asset('storage/' . Auth::user()->image) }}"
                alt="{{ auth()->user()->name }}'s Avatar">
            <p>{{ auth()->user()->name }}</p>
            <p>{{ auth()->user()->role }}</p>
        </div>
    @else
        <p class="text-red-500">Unauthorized Access</p>
    @endif
</div>
