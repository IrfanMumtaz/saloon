<?php

namespace App\Http\Resources;

use App\Http\Resources\BaseResponse;

class ServiceResource extends BaseResponse
{
    public static $wrap = 'service';
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this['id'],
            'name' => $this['name'],
            'time_available' => ServiceSlotResource::collection($this['time_available'])
        ];
    }
}
