<?php

namespace App\Http\Requests\Api\V1\Transaction;

use App\Http\Requests\PaginateAndOrderableAndSearchableRequest;
use Illuminate\Validation\Rule;

class IndexTransactionRequest extends PaginateAndOrderableAndSearchableRequest
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
            'card_number' => ['nullable',Rule::exists('accounts','card_number')]
        ];
    }

    public function orderBy(): array
    {
        return ['amount', 'created_at', 'updated_at'];
    }

}
