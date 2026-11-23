<?php

namespace App\Livewire\Concerns;

use Illuminate\Support\Facades\Auth;

/**
 * Livewire runs boot{TraitName}() on the initial render and on every
 * subsequent component request, so admin-only actions stay protected
 * even when called directly through /livewire/update.
 */
trait AuthorizesAdmin
{
    public function bootAuthorizesAdmin(): void
    {
        abort_unless(Auth::user()?->role === 'admin', 403);
    }
}
