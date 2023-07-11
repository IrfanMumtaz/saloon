<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = ['service_id', 'date', 'time_start', 'time_end', 'time_buffered', 'first_name', 'last_name', 'email'];
}
