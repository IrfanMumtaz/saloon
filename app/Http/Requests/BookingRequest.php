<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
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
    public function rules()
    {
        return [
            "service_id" => "required|exists:services,id",
            "date" => "required|date_format:Y-m-d|after_or_equal:" . date("Y-m-d"),
            "time_start" => "required|date_format:H:i",
            "time_end" => "required|date_format:H:i|after_or_equal:time_start",
            "customers" => "required|array",
            "customers.*.first_name" => "required|string|max:100",
            "customers.*.last_name" => "required|string|max:100",
            "customers.*.email" => "required|email|max:100",
        ];
    }
}
