<?php

namespace App\Observers;

use App\Models\Account;

class AccountObserve
{

    /**
     * Handle the Transfer "creating" event.
     *
     * @param Account $account
     * @return void
     */
    public function creating(Account $account)
    {
        $card_number = fake()->numberBetween(1000000000000000,9999999999999999);
        while (Account::query()->where('card_number', $card_number)->exists()) {
            $card_number = fake()->numberBetween(1000000000000000,9999999999999999);
        }
        $account->setAttribute('card_number', $card_number);
    }

    /**
     * Handle the Account "created" event.
     *
     * @param Account $account
     * @return void
     */
    public function created(Account $account)
    {
        //
    }

    /**
     * Handle the Account "updated" event.
     *
     * @param Account $account
     * @return void
     */
    public function updated(Account $account)
    {
        //
    }

    /**
     * Handle the Account "deleted" event.
     *
     * @param Account $account
     * @return void
     */
    public function deleted(Account $account)
    {
        //
    }

    /**
     * Handle the Account "restored" event.
     *
     * @param Account $account
     * @return void
     */
    public function restored(Account $account)
    {
        //
    }

    /**
     * Handle the Account "force deleted" event.
     *
     * @param Account $account
     * @return void
     */
    public function forceDeleted(Account $account)
    {
        //
    }
}
