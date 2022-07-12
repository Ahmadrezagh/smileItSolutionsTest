<?php

namespace App\Enums;

use Spatie\Enum\Laravel\Enum;

/**
 * @method static self DEPOSIT()
 * @method static self WITHDRAW()
 * @method static self TRANSFER()
 */
final class TransactionReason extends Enum
{
    protected static function labels()
    {
        return [
            'DEPOSIT' => 'Deposit',
            'WITHDRAW' => 'Withdraw',
            'TRANSFER' => 'Transfer',
        ];
    }

    protected static function values()
    {
        return [
            'DEPOSIT' => 'deposit',
            'WITHDRAW' => 'withdraw',
            'TRANSFER' => 'transfer',
        ];
    }
}
