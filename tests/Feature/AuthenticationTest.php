<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertSee('Masuk ke Akun');
    }

    public function test_user_can_authenticate_using_login_screen(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make('password123'),
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password123',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('smartresident.index'));

        $user->delete();
    }

    public function test_user_cannot_authenticate_with_invalid_password(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make('password123'),
        ]);

        $response = $this->from('/login')->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('email');

        $user->delete();
    }

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
        $response->assertSee('Daftar Akun Baru');
    }

    public function test_new_user_can_register(): void
    {
        $email = 'testnewuser_' . time() . '@example.com';

        $response = $this->post('/register', [
            'name' => 'Warga Baru',
            'email' => $email,
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('smartresident.index'));

        $this->assertDatabaseHas('users', [
            'email' => $email,
        ]);

        // Clean up
        User::where('email', $email)->delete();
    }

    public function test_registration_fails_if_password_confirmation_does_not_match(): void
    {
        $response = $this->from('/register')->post('/register', [
            'name' => 'Warga Gagal',
            'email' => 'gagal_' . time() . '@example.com',
            'password' => 'password123',
            'password_confirmation' => 'berbeda123',
        ]);

        $this->assertGuest();
        $response->assertRedirect('/register');
        $response->assertSessionHasErrors('password');
    }

    public function test_unauthenticated_user_cannot_access_lapor_page_and_is_redirected_to_login(): void
    {
        $response = $this->get('/lapor');

        $response->assertRedirect('/login');
    }

    public function test_authenticated_user_can_access_lapor_page(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/lapor');

        $response->assertStatus(200);
        $response->assertSee('Form Pelaporan Kerusakan');

        $user->delete();
    }

    public function test_authenticated_user_can_logout(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/logout');

        $this->assertGuest();
        $response->assertRedirect(route('smartresident.index'));

        $user->delete();
    }
}
