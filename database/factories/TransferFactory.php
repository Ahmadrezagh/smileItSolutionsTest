<?php

namespace Database\Factories;

use App\Models\Account;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transfer>
 */
class TransferFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $accounts = Account::query()->pluck('id')->toArray();
        return [
            'from_account_id' => ($fromAccount = fake()->randomElement($accounts)),
            'to_account_id' => fake()->randomElement(Arr::except($accounts, $fromAccount)),
            'amount' => fake()->numberBetween(10, 1000),
            'fee' => 1,
        ];
    }
}
