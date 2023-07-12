<?php

namespace tests\Auth\Feature\Central\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TenantTestCase;
use App\Models\User;

class NewPasswordControllerTest extends TenantTestCase
{
    use RefreshDatabase;

    protected $tenancy = true;



    /** @test */
    public function a_user_can_only_set_new_password_if_logged_in()
    {
        auth()->logout();

        $this->postJson(route("api.user.new-password"), [
            'old_password' => 'password',
            'password' => 'password',
        ])->assertForbidden();
    }

    /** @test */
    public function a_user_can_only_set_new_password_if_old_password_is_correct()
    {
        $user = User::factory()->create(['password' => Hash::make('password')]);
        $this->actingAs($user);

        $this->postJson(route("api.user.new-password"), [
            'old_password' => 'wrong-password',
            'password' => 'password',
        ])->assertStatus(422);
    }

    /** @test */
    public function a_user_can_reset_their_password()
    {
        $user = User::factory()->create(['password' => Hash::make('password')]);
        $this->actingAs($user);

        $this->postJson(route("api.user.new-password"), [
            'old_password' => 'password',
            'password' => 'new-password',
        ])->assertOk();

        $this->assertTrue(Hash::check('new-password', $user->fresh()->password));
    }
}
