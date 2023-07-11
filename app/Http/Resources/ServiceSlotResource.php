<?php

namespace App\Http\Resources;

use App\Http\Resources\BaseResponse;

class ServiceSlotResource extends BaseResponse
{
    public static $wrap = 'service_slot';
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'date' => $this['date'],
            'start_time' => $this['start_time'],
            'end_time' => $this['end_time']
        ];
    }
}
