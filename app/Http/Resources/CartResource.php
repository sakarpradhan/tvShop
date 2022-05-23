<?php

namespace App\Http\Resources;

use App\Models\Tv;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
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
            'cart_id'   =>  $this->id,
            'tv_id'     =>  $this->tv_id,
            'quantity'  =>  $this->quantity,
            'tv'        =>  new TvResource($this->tv)
        ];
    }
}
