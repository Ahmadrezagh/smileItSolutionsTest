<?php

namespace App\Http\Requests\Api\V1\Account;

use App\Http\Requests\PaginateAndOrderableAndSearchableRequest;

class IndexAccountRequest extends PaginateAndOrderableAndSearchableRequest
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

    public function orderBy(): array
    {
        return ['balance', 'created_at', 'updated_at'];
    }
}
