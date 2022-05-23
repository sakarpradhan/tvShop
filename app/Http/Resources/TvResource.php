<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TvResource extends JsonResource
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
            'tv_id' =>  $this->id,
            'model' =>  $this->model,
            'price' =>  $this->price,
            'path'  =>  asset('storage/' . $this->path)
        ];
    }
}
