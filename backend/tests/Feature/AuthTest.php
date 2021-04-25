<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Tests\Feature\BaseUtils;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends BaseUtils

{

    use WithFaker;
    use RefreshDatabase;

    /**
     * Test user can register
     * @return void
     */
    public function testUserCanRegister()
    {
        $this->withoutExceptionHandling();
        $response = $this->register();
        $response->assertStatus(201);
        $users = User::all();
        $this->assertCount(1, $users);
    }


    /**
     * test if user can sign in
     */
    public function testUserCanSignin()
    {
          $this->withoutExceptionHandling();
        $response = $this->login();
        $response->assertStatus(200);
    }


    public function testCanPasswordResetCanBeRequest()
    {
        $response = $this->register();
         $this->withoutExceptionHandling();
        $response = $this->post('api/auth/forget',[
            'email' => $this->email
        ]);

        $response->assertStatus(200);
    }


      public function testCanChangePasswordWithToken()
    {
        $response = $this->register();
         $this->withoutExceptionHandling();
        $response = $this->post('api/auth/forget',[
            'email' => $this->email
        ]);
        $user = User::where(
            'email',$this->email
        )->first();

         $response = $this->post('api/auth/reset',[
            'token' => $user->recovery_token,
            'password'=>'newpassword'
        ]);

        $response->assertStatus(200);

        $this->withoutExceptionHandling();
        $response = $this->login();
        $response->assertStatus(401);
    }


 /**
     * test user can sign out
     *
     * @return void
     */
    public function testUserCanSignout()
    {
        $response = $this->login();
        $token = $response->getData()->data->token;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('api/auth/logout');

        $response->assertStatus(200);
    }

}
