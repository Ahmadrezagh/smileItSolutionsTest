<?php

namespace App\Models;

use App\Enums\TransactionReason;
use App\Enums\TransactionType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Transaction extends Model
{
    use HasFactory;

    protected $with = ['account'];

    protected $fillable = [
        'account_id',
        'code',
        'amount',
        'type',
        'reason',
    ];

    protected $casts = [
        'code' => 'integer',
        'amount' => 'double',
        'type' => TransactionType::class,
        'reason' => TransactionReason::class,
    ];

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function transfer(): HasOne
    {
        return $this->hasOne(Transfer::class);
    }
}
