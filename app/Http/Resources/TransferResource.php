<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransferResource extends JsonResource
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
            'from_account' => new AccountResource($this->resource->fromAccount),
            'to_account' => new AccountResource($this->resource->toAccount),
            'deposit_transaction' => new TransactionResource($this->resource->depositTransaction),
            'withdraw_transaction' => new TransactionResource($this->resource->withdrawTransaction),
            'fee' => $this->resource->fee,
            'created_at' => $this->resource->created_at->timestamp,
            'updated_at' => $this->resource->updated_at->timestamp,
        ];
    }
}
