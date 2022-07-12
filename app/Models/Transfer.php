<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transfer extends Model
{
    use HasFactory;

    protected $with = ['from_account', 'to_account', 'deposit_transaction', 'withdraw_transaction'];

    protected $fillable = [
        'from_account_id',
        'to_account_id',
        'deposit_transaction_id',
        'withdraw_transaction_id',
        'fee'
    ];

    public function fromAccount(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'from_account_id');
    }

    public function toAccount(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'to_account_id');
    }

    public function depositTransaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class, 'deposit_transaction_id');
    }

    public function withdrawTransaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class, 'withdraw_transaction_id');
    }
}
