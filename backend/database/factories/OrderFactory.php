<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Offer;
use App\Models\Order;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $sellerID = User::factory()->create()->id;
       $offer= Offer::create(
                [
                    'currency_id'=>2,
                    'seller_id'=>$sellerID,
                    'min'=>10,
                    'max'=>100,
                    'amount'=>5000,
                    'rate'=>89,
                    'expire_duration'=>45,

                ]
                );
        return [

            'seller_id' => $sellerID,
            'buyer_id' => User::factory()->create()->id,
            'amount'=>600,
            'rate'=>87,
            'offer_id'=>$offer->id,
        ];
    }
}
