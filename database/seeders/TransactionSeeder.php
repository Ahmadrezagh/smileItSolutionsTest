<?php

namespace Database\Seeders;

use App\Models\Transaction;

class TransactionSeeder extends BaseSeeder
{
    public function init()
    {
        //
    }

    public function fake()
    {
        Transaction::factory(300)->create();
    }
}
