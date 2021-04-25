<?php

namespace Tests\Feature;

use Tests\TestCase;
use Tests\Feature\BaseUtils;
use Database\Seeders\CountrySeeder;
use Database\Seeders\CurrencySeeder;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CurrencyTest extends BaseUtils
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_get_currencies()
    {
        $seeder=  new CountrySeeder();
        $seeder->run();
        $seeder=  new CurrencySeeder();
        $seeder->run();
        $response = $this->get('/api/currency');
        $response->assertStatus(200);
        $this->assertGreaterThan(0,count($response->getData()->data->currencies));

    }
}
