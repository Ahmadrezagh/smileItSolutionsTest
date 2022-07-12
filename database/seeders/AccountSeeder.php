<?php

namespace Database\Seeders;

use App\Models\Account;

class AccountSeeder extends BaseSeeder
{

    public function init()
    {
        //
    }

    public function fake()
    {
        Account::factory(30)->create();
    }
}
