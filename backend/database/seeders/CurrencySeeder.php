<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Currency::create([
            'name'=>'Nigerian Naira',
            'code'=>'NGN',
            'symbol'=> '₦',
            'lowest_unit'=>'Kobo',
            'lowest_unit_rate'=>100,
            'country_id'=> Country::where('name','Nigeria')->first()->id
        ]);


        Currency::create([
            'name'=>'Chinese Yuan',
            'code'=>'RMB',
            'symbol'=> '¥',
            'lowest_unit'=>'fen',
            'buyable'=>'yes',
            'lowest_unit_rate'=>100,
            'country_id'=> Country::where('name','China')->first()->id
        ]);
    }
}
