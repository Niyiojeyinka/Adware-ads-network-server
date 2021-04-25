<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BaseUtils extends TestCase
{
    use WithFaker;
    use RefreshDatabase;
    public $email;
    public $password;

    public function __construct()
    {
        parent::__construct();
        $this->password = "password";
        $this->email = "test@gmail.com";
    }

    public function register($email = null, $password = null)
    {
        $this->password = is_null($password) ? $this->password : $password;
        $this->email = is_null($email) ? $this->email : $email;

        return $this->post('api/auth/register', [
            'firstname' => $this->faker()->firstName(),
            'lastname' => $this->faker()->lastName(),
            'middlename' => $this->faker()->lastName(),
            'password' => $this->password,
            'email' => $this->email,
        ]);
    }

    public function login()
    {

        $reg = $this->register();
        return $this->post('api/auth/login', [
            'password' => $this->password,
            'email' => $this->email,
        ]);
    }


       public function logout($token)
    {


        return $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('api/auth/logout');
        }

}
