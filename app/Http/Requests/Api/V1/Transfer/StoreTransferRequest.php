<?php

namespace App\Http\Requests\Api\V1\Transfer;

use App\Models\Account;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTransferRequest extends FormRequest
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
    public function rules()
    {
        return [
            'from_card_number' => ['required', Rule::exists('accounts', 'card_number')],
            'to_card_number' => ['required', Rule::exists('accounts', 'card_number')],
            'fee' => ['numeric', 'numeric'],
            'amount' => ['numeric', 'numeric']
        ];
    }

    public function convertedData()
    {
        return $this->safe()->merge([
            'from_account_id' => Account::query()->where('card_number', '=', $this->from_card_number)->first()->id,
            'to_account_id' => Account::query()->where('card_number', '=', $this->to_card_number)->first()->id,
        ])->except([
            'from_card_number',
            'to_card_number'
        ]);
    }
}
