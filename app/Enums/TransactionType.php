<?php

namespace App\Enums;

use Spatie\Enum\Laravel\Enum;

/**
 * @method static self DEPOSIT()
 * @method static self WITHDRAW()
 */
final class TransactionType extends Enum
{
    protected static function labels()
    {
        return [
            'DEPOSIT' => 'Deposit',
            'WITHDRAW' => 'Withdraw',
        ];
    }

    protected static function values()
    {
        return [
            'DEPOSIT' => 'deposit',
            'WITHDRAW' => 'withdraw',
        ];
    }
}
