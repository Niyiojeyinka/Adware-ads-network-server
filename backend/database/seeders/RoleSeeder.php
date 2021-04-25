<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name'=>'User',
            'key'=>'user'
        ]);
         Role::create([
            'name'=>'Admin',
            'key'=>'admin'
        ]);

         Role::create([
            'name'=>'Mediator',
            'key'=>'mediator'
        ]);
    }
}
