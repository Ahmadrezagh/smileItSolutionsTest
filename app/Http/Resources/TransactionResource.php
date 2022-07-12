<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'account' => new AccountResource($this->resource->account),
            'amount' => abs($this->resource->amount),
            'type' => [
                'label' => $this->resource->type->label,
                'value' => $this->resource->type->value,
            ],
            'reason' => [
                'label' => $this->resource->reason->label,
                'value' => $this->resource->reason->value,
            ],
            'created_at' => $this->resource->created_at->timestamp,
            'updated_at' => $this->resource->updated_at->timestamp,
        ];
    }
}
