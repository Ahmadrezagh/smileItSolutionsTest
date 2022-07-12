<?php

namespace App\Observers;

use App\Enums\TransactionReason;
use App\Enums\TransactionType;
use App\Models\Transaction;
use App\Models\Transfer;

class TransferObserve
{
    /**
     * Handle the Transfer "creating" event.
     *
     * @param \App\Models\Transfer $transfer
     * @return void
     */
    public function creating(Transfer $transfer)
    {
        $depositTransaction = Transaction::create([
            'reason' => TransactionReason::TRANSFER(),
            'type' => TransactionType::DEPOSIT(),
            'account_id' => $transfer->to_account_id,
            'amount' => $transfer->amount,
        ]);
        $withdrawTransaction = Transaction::create([
            'reason' => TransactionReason::TRANSFER(),
            'type' => TransactionType::WITHDRAW(),
            'account_id' => $transfer->from_account_id,
            'amount' => $transfer->amount + $transfer->fee,
        ]);

        $transfer->setAttribute('deposit_transaction_id', $depositTransaction->id);
        $transfer->setAttribute('withdraw_transaction_id', $withdrawTransaction->id);
    }

    /**
     * Handle the Transfer "created" event.
     *
     * @param \App\Models\Transfer $transfer
     * @return void
     */
    public function created(Transfer $transfer)
    {
        //
    }

    /**
     * Handle the Transfer "updated" event.
     *
     * @param \App\Models\Transfer $transfer
     * @return void
     */
    public function updated(Transfer $transfer)
    {
        //
    }

    /**
     * Handle the Transfer "deleted" event.
     *
     * @param \App\Models\Transfer $transfer
     * @return void
     */
    public function deleted(Transfer $transfer)
    {
        //
    }

    /**
     * Handle the Transfer "restored" event.
     *
     * @param \App\Models\Transfer $transfer
     * @return void
     */
    public function restored(Transfer $transfer)
    {
        //
    }

    /**
     * Handle the Transfer "force deleted" event.
     *
     * @param \App\Models\Transfer $transfer
     * @return void
     */
    public function forceDeleted(Transfer $transfer)
    {
        //
    }
}
