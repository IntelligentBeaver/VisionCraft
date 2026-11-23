<?php

use App\Livewire\Dashboard\ManageUsers;
use App\Models\User;
use Livewire\Livewire;

$adminRoutes = ['/admin/stats', '/admin/users/create', '/admin/users/manage', '/admin/create', '/admin/manage'];

it('blocks regular users from admin pages', function (string $uri) {
    $user = User::factory()->create(['role' => 'user']);

    $this->actingAs($user)->get($uri)->assertForbidden();
})->with($adminRoutes);

it('redirects guests from admin pages to login', function (string $uri) {
    $this->get($uri)->assertRedirect('/login');
})->with($adminRoutes);

it('lets admins open admin pages', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $this->actingAs($admin)->get('/admin/stats')->assertOk();
});

it('blocks regular users from calling admin livewire actions', function () {
    $user = User::factory()->create(['role' => 'user']);
    $victim = User::factory()->create();

    Livewire::actingAs($user)->test(ManageUsers::class)->assertForbidden();

    expect(User::find($victim->id))->not->toBeNull();
});
