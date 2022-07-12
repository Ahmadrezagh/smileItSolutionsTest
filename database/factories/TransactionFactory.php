<?php

namespace Database\Factories;

use App\Enums\TransactionType;
use App\Models\Account;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'account_id' => $this->faker->randomElement(Account::query()->pluck('id')->toArray()),
            'type' => ($type = $this->faker->randomElement(TransactionType::cases())),
            'amount' => $this->faker->numberBetween(10,1000),
            'reason' => $type
        ];
    }
}
