<?php

namespace Database\Seeders;

use App\Models\Transfer;

class TransferSeeder extends BaseSeeder
{
    public function init()
    {
        //
    }

    public function fake()
    {
        Transfer::factory(50)->create();
    }
}
