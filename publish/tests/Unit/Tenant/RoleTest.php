<?php

namespace Tests\Chat\Unit\Tenant;

use PHPUnit\Framework\Attributes\Test;
use ReesMcIvor\Auth\Models\Role;
use Tests\TenantTestCase;
use App\Models\User;

class RoleTest extends TenantTestCase {

    protected $tenancy = true;

    #[Test]
    public function a_user_can_contain_one_chat_thread()
    {
        $user = User::factory()->create();
        $role = Role::factory()->create();
        $user->roles()->attach($role);
    }

}
