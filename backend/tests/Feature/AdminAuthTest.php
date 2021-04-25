<?php

namespace Tests\Feature;

use App\Models\Admin;
use Tests\Feature\BaseUtils;

class AdminAuthTest extends BaseUtils
{

    /**
     * test to confirm admin can login
     *
     * @return void
     */
    public function testAdminCanLogin()
    {
        $password = $this->faker->word();

        $admin_user = Admin::create([
            'username' => $this->faker->username,
            'email' => $this->faker->safeEmail,
            'password' => $password,
        ]);

        $response = $this->post('/api/admin/login', [
            'email' => $admin_user->email,
            'password' => $password,
        ]);

        $response->assertStatus(200);
    }
}
