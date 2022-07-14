<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class PaginateAndOrderableAndSearchableRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        $this->merge([
            'page' => $this->query('page', 1),
            'perPage' => $this->query('perPage', 15),
            'orderBy' => $this->query('orderBy', $this->defaultOrderBy()),
            'orderType' => $this->query('orderType','desc'),
        ]);
    }

    public function defaultOrderBy(): string
    {
        return 'created_at';
    }

    public function orderBy(): array
    {
        return ['created_at', 'updated_at'];
    }

    public function addRules(): array
    {
        return [];
    }

    public function rules(): array
    {
        return array_merge($this->defaultRules(), $this->addRules());
    }

    public function defaultRules(): array
    {
        return [
            'page' => ['sometimes', 'numeric', 'min:1'],
            'perPage' => ['sometimes', 'numeric', 'min:1'],
            'orderBy' => ['sometimes', 'in:' . implode(',', $this->orderBy())],
            'orderType' => ['required_with:orderBy', 'in:asc,desc,ASC,DESC'],
        ];
    }
}
