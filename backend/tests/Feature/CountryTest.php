<?php

namespace Tests\Feature;

use Database\Seeders\CountrySeeder;
use Tests\TestCase;
use Tests\Feature\BaseUtils;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CountryTest extends BaseUtils
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

       public function test_can_get_countries()
    {
        $seeder=  new CountrySeeder();
        $seeder->run();
        $response = $this->get('/api/country');
        $response->assertStatus(200);
        $this->assertGreaterThan(1,count($response->getData()->data->countries));

    }
}
