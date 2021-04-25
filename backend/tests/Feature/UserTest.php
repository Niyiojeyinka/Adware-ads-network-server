<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\Feature\BaseUtils;
use Illuminate\Foundation\Testing\WithFaker;

class UserTest extends BaseUtils
{
    use WithFaker;

    public $token;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * test user can edit profile
     *
     * @return void
     */
    public function testEditProfile()
    {
        $response = $this->login();
        $logeduser = $response->getData()->data->user;
        $token = $response->getData()->data->token;
        $new_password = $this->faker()->word();
        $new_phone = $this->faker()->randomNumber(9, true);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->put('api/profile', [
            'password' => $new_password,
            'phone' => $new_phone,
        ]);
        $response->assertStatus(200);

        $response = $this->post('api/auth/login', [
            'password' => $new_password,
            'email' => $logeduser->email,
        ]);
        $response->assertStatus(200);
    }

    /**
     * test user can view profile
     *
     * @return void
     */
    public function testViewProfile()
    {
        $response = $this->login();
        $token = $response->getData()->data->token;
        $user = $response->getData()->data->user;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('api/profile/' . $user->id);

        $response->assertStatus(200);
    }



    /**
     * test user can set password
     *
     * @return void
     */
    public function testUserCanSetPin()
    {
        $response = $this->login();
        $token = $response->getData()->data->token;
        $user = $response->getData()->data->user;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('api/pin' ,[
            'pin'=>8989
        ]);
        $response->assertStatus(200);

         $user=User::find($user->id);
         $this->assertNotEmpty($user->pin);
    }

       /**
     * test user cannot set invalid password
     *
     * @return void
     */
    public function testUserCannotSetInvalidPin()
    {
        $response = $this->login();
        $token = $response->getData()->data->token;
        $user = $response->getData()->data->user;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('api/pin' ,[
            'pin'=>898998
        ]);

        $response->assertStatus(400);

    }
}
