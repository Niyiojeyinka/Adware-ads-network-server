<?php

namespace Tests\Feature;

use App\Models\Account;
use Tests\TestCase;
use App\Models\Offer;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TradeTest extends BaseUtils
{
/**
     * A basic feature test example.
     *
     * @return void
     */
    public function testuserCanBuyoffer()
    {
        $this->withoutExceptionHandling();
        $response = $this->login();
        $seller = $response->getData()->data->user;
        $token = $response->getData()->data->token;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('api/offer', [
            'currency_id'=>2,
            'min'=>10,
            'max'=>100,
            'amount'=>5000,
            'rate'=>89,
            'expire'=>45,
        ]);

        Account::where('user_id',$seller->id)->update(['balance'=> 10000]);
        $response->assertStatus(201);
        $this->logout($token);
        $offer= Offer::where('seller_id',$seller->id)->first();
        $response = $this->login();
       //$buyer = $response->getData()->data->user;
        $token = $response->getData()->data->token;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('api/order/'.$offer->id, [
            'amount'=>500
        ]);

      //  dd($response);
        $response->assertStatus(200);


    }
}
