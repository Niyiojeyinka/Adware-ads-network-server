<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User as User;

class UserAuthTest extends TestCase
{
    private $baseURL = 'api/user/';
    use RefreshDatabase;

    public function register()
    {
        return $this->post(
            $this->baseURL . 'register',

            [
                'firstname' => 'Test',
                'lastname' => 'Doe',
                'phone' => '2345678',
                'email' => 'test@email.com',
                'password' => 'testpassword',
                'country_id' => 1,
            ]
        );
    }

    /** Test if user can register
     * @test
     * @return void */
    public function new_user_can_register()
    {
        $response = $this->register();
        $this->assertCount(1, User::all());
        $response->assertStatus(201);
    }

    /** Test for duplicate email
     * @test
     * @return void */
    public function email_is_unique()
    {
        $response = $response = $this->register();

        $response = $response = $this->register();

        $response->assertStatus(400);
        $response->assertJSON(['result' => 0]);
        $this->assertCount(1, User::all());
    }

    /** Test if user can sign in
     *  @test
     *  @return void */
    public function user_can_login()
    {
        $this->register();
        $this->assertCount(1, User::all());

        $response = $this->post($this->baseURL . 'login', [
            'email' => 'test@email.com',
            'password' => 'testpassword',
        ]);
        $response->assertJSON(['result' => 1]);
        $response->assertOk();
    }
    /** Test Wrong user cant sign in
     * @test
     *  @return void */
    public function wrong_user_cannot_login()
    {
        $this->register();
        $this->assertCount(1, User::all());

        $response = $this->post($this->baseURL . 'login', [
            'email' => 'wrong@email.com',
            'password' => 'testpassword',
        ]);
        $response->assertJSON(['result' => 0]);
        $response->assertStatus(401);
    }

    /** Test if user can logout
     * @test
     *  @return void */
    public function user_can_logout()
    {
        $this->register();
        $payload = [
            'email' => 'test@email.com',
            'password' => 'testpassword',
        ];
        $response = $this->post($this->baseURL . 'login', $payload);

        $data = $response->decodeResponseJson();
        $token = $data['data']['token'];
        $logout = $this->post(
            $this->baseURL . 'logout',
            [],
            ['HTTP_Authorization' => 'Bearer' . $token]
        );

        $logout->assertJSON(['result' => 1]);
        $logout->assertOk();
    }
}
