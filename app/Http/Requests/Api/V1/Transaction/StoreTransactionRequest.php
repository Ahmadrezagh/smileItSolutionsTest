<?php

namespace App\Http\Requests\Api\V1\Transaction;

use App\Enums\TransactionType;
use App\Models\Account;
use App\Rules\TransactionTypeRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Spatie\Enum\Laravel\Rules\EnumRule;

class StoreTransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules():array
    {
        return [
            'card_number' => ['required',Rule::exists('accounts','card_number')],
            'amount' => ['required'],
            'type' => ['required',new EnumRule(TransactionType::class)],
        ];
    }
    public function convertedData()
    {
        return $this->safe()->merge([
            'account_id' => Account::query()->where('card_number', '=', $this->card_number)->first()->id,
            'reason' => $this->type,
        ])->except([
            'card_number',
        ]);
    }
}
