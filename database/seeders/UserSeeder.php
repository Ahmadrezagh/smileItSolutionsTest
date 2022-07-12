<?php

namespace Database\Seeders;

use App\Models\User;

class UserSeeder extends BaseSeeder
{
    public function init()
    {
        //
    }

    public function fake()
    {
        User::factory(20)->create();
    }
}
