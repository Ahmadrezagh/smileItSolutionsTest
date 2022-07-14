<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transfer extends Model
{
    use HasFactory;

    protected $with = ['fromAccount', 'toAccount', 'depositTransaction', 'withdrawTransaction'];

    protected $fillable = [
        'from_account_id',
        'to_account_id',
        'deposit_transaction_id',
        'withdraw_transaction_id',
        'fee',
        'amount'
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

    public function scopeFilterByFromAccountCardNumber(Builder $builder, $account_card_number = null): Builder
    {
        if($account_card_number)
        {
            $builder->whereHas('fromAccount',function (Builder $query) use ($account_card_number) {
                $query->where('card_number','=',$account_card_number);
            });
        }
        return $builder;
    }

    public function scopeFilterByToAccountCardNumber(Builder $builder, $account_card_number = null): Builder
    {
        if($account_card_number)
        {
            $builder->whereHas('toAccount',function (Builder $query) use ($account_card_number) {
                $query->where('card_number','=',$account_card_number);
            });
        }
        return $builder;
    }

    public function scopeFilterByAccountCardNumber(Builder $builder, $account_card_number = null): Builder
    {
        if($account_card_number)
        {
            $builder->whereHas('toAccount',function (Builder $query) use ($account_card_number) {
                $query->where('card_number','=',$account_card_number);
            })->orWhereHas('fromAccount',function (Builder $query) use ($account_card_number) {
                $query->where('card_number','=',$account_card_number);
            });
        }
        return $builder;
    }

    public function getRouteKeyName()
    {
        return 'code';
    }
}
