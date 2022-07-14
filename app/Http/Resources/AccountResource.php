<?php

namespace App\Http\Resources;


class AccountResource extends BaseResource
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
            'id' => $this->resource->id,
            'user' => new UserResource($this->resource->user),
            'balance' => $this->resource->balance,
            'card_number' => $this->resource->card_number,
            'created_at' => $this->resource->created_at->timestamp,
            'updated_at' => $this->resource->updated_at->timestamp,
        ];
    }
}
