<?php

namespace Tests\Feature;

use App\Models\Account;
use Tests\Feature\BaseUtils;

class TransferTest extends BaseUtils
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * test user can transfer
     *
     * @return void
     */
    public function testCanUserTransfer()
    {
        $userdata1 = $this->register($this->faker->safeEmail(), $this->faker->word())->getData()->data;
        $userdata2 = $this->register($this->faker->safeEmail(), $this->faker->word())->getData()->data;
        $response = $this->transfer($userdata1, $userdata2, 200);
        $response->assertStatus(200);
    }

    public function transfer($userdata1, $userdata2, $amount)
    {
        Account::where('user_id', $userdata1->user->id)->update([
            'balance' => 400,
        ]);

        return $this->withHeaders([
            'Authorization' => 'Bearer ' . $userdata1->token,
        ])->post('/api/transfer', [
            'receiver' => $userdata2->user->email,
            'amount' => $amount,
        ]);
    }

    public function testUserCanViewATransfer()
    {
        $userdata1 = $this->register($this->faker->safeEmail, $this->faker->word())->getData()->data;
        $userdata2 = $this->register($this->faker->safeEmail, $this->faker->word())->getData()->data;
        $response = $this->transfer($userdata1, $userdata2, 200);
        $transfer = $response->getData()->data->transfer;
        $response = $this->viewATransfer($userdata1->token, $transfer->id);
        $response->assertStatus(200);
    }

    public function viewATransfer($token, $id)
    {
        return $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('api/transfer/' . $id);
    }

    public function testUserCanRetrieveTransfers()
    {
        $userdata1 = $this->register($this->faker->safeEmail, $this->faker->word())->getData()->data;
        $userdata2 = $this->register($this->faker->safeEmail, $this->faker->word())->getData()->data;
        $response = $this->transfer($userdata1, $userdata2, 200);
        $response = $this->retrieveTransfers($userdata1->token);
        $response->assertStatus(200);
    }

    public function retrieveTransfers($token)
    {
        return $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('api/transfer');
    }

}
