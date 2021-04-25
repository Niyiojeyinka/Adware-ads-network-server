<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Offer;
use Tests\Feature\BaseUtils;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OfferTest extends BaseUtils
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_offerCanBeCreated()
    {
        $this->withoutExceptionHandling();
        $response = $this->login();
        $loggeduser = $response->getData()->data->user;
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
        $response->assertStatus(201);
        $offers= Offer::where('seller_id',$loggeduser->id)->get();
            $this->assertGreaterThan(0,count($offers));
    }


    public function testCanGetUsersOffers()
    {

        $this->withoutExceptionHandling();
        $response = $this->login();
        $loggeduser = $response->getData()->data->user;
        $token = $response->getData()->data->token;

        $offer = Offer::create(
                [
                    'currency_id'=>2,
                    'seller_id'=>$loggeduser->id,
                    'min'=>10,
                    'max'=>100,
                    'amount'=>5000,
                    'rate'=>89,
                    'expire_duration'=>45,

                ]
                );
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('api/offer');

        $response->assertStatus(200);
        $this->assertGreaterThan(0,count($response->getData()->data->offers));

    }



    public function testCanGetAUserOffer()
    {
          $this->withoutExceptionHandling();
        $response = $this->login();
        $loggeduser = $response->getData()->data->user;

        $offer = Offer::create(
            [
                'currency_id'=>2,
                'seller_id'=>$loggeduser->id,
                'min'=>10,
                'max'=>100,
                'amount'=>5000,
                'rate'=>89,
                'expire_duration'=>45,

            ]
            );


        $token = $response->getData()->data->token;


        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('api/offer/'.$offer->id);

        $response->assertStatus(200);
        $this->assertEquals($offer->amount,$response->getData()->data->offer->amount);

    }
}
