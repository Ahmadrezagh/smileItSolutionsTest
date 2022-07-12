<?php

namespace App\Observers;

use App\Enums\TransactionType;
use App\Models\Transaction;

class TransactionObserve
{
    /**
     * Handle the Transaction "creating" event.
     *
     * @param Transaction $transaction
     * @return void
     */
    public function creating(Transaction $transaction)
    {
        $code = fake()->numberBetween(8);
        while (Transaction::query()->where('code', $code)->exists()) {
            $code = fake()->numberBetween(8);
        }

        $transaction->setAttribute('amount', $transaction->type->equals(TransactionType::DEPOSIT()) ? abs($transaction->amount) : -abs($transaction->amount));
        $transaction->setAttribute('code', $code);
    }

    /**
     * Handle the Transaction "created" event.
     *
     * @param Transaction $transaction
     * @return void
     */
    public function created(Transaction $transaction)
    {
        $transaction->account()->increment('balance', $transaction->amount);
    }

    /**
     * Handle the Transaction "updated" event.
     *
     * @param Transaction $transaction
     * @return void
     */
    public function updated(Transaction $transaction)
    {
        //
    }

    /**
     * Handle the Transaction "deleted" event.
     *
     * @param Transaction $transaction
     * @return void
     */
    public function deleted(Transaction $transaction)
    {
        //
    }

    /**
     * Handle the Transaction "restored" event.
     *
     * @param Transaction $transaction
     * @return void
     */
    public function restored(Transaction $transaction)
    {
        //
    }

    /**
     * Handle the Transaction "force deleted" event.
     *
     * @param Transaction $transaction
     * @return void
     */
    public function forceDeleted(Transaction $transaction)
    {
        //
    }
}
