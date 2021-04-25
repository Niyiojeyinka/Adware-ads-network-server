<?php

namespace Tests\Feature;

use App\Models\Order;

class OrderTest extends BaseUtils
{
    public function testCanGetSales()
    {

        $this->withoutExceptionHandling();
        $response = $this->login();
        $token = $response->getData()->data->token;

        $order = Order::factory()->create(
            [
                'seller_id' => $response->getData()->data->user->id,
            ]
        );
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('api/sale');

        $response->assertStatus(200);
        $this->assertGreaterThan(0, count($response->getData()->data->sales));

    }

    public function testCanGetASellerOrder()
    {
        $this->withoutExceptionHandling();
        $response = $this->login();
        $order = Order::factory()->create(
            [
                'seller_id' => $response->getData()->data->user->id,
            ]
        );
        $token = $response->getData()->data->token;
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('api/sale/' . $order->id);

        $response->assertStatus(200);
        $this->assertEquals($order->amount, $response->getData()->data->sale->amount);

    }

    public function testCanGetBuyerOrders()
    {

        $this->withoutExceptionHandling();
        $response = $this->login();
        $token = $response->getData()->data->token;

        $order = Order::factory()->create([
            'buyer_id' => $response->getData()->data->user->id,
        ]);
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('api/order');

        $response->assertStatus(200);
        $this->assertGreaterThan(0, count($response->getData()->data->orders));

    }

    public function testCanGetABuyerOrder()
    {
        $this->withoutExceptionHandling();
        $response = $this->login();
        $order = Order::factory()->create([
            'buyer_id' => $response->getData()->data->user->id,
        ]);
        $token = $response->getData()->data->token;
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('api/order/' . $order->id);

        $response->assertStatus(200);
        $this->assertEquals($order->amount, $response->getData()->data->order->amount);

    }
}
