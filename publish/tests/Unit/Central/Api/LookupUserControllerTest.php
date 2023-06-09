<?php

namespace tests\Auth\Feature\Central\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
use App\Models\Tenant;
use App\Models\User;

class LookupUserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_returns_a_list_of_domains()
    {
        $tenant = Tenant::factory()->create(['domain' => 'tenancy1.test']);
        tenancy()->initialize($tenant);
        $user = User::factory()->create();
        tenancy()->end();

        Artisan::call("tenants:users:map");

        $response = $this->json('GET', '/api/user/lookup', [
            'email' => $user->email,
        ])->assertSuccessful();

        $response->assertJsonFragment(['domain' => 'tenancy1.test']);
    }
}
