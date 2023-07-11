<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = [
            [
                'name' => "Men Hair Cutting",
                'duration_minutes' => 30,
                'capacity' => 3,
                'sloting_minutes' => 10,
                'sloting_break' => 5,
                'booking_capacity_days' => 7,
            ],
            [
                'name' => "Women Hair Cutting",
                'duration_minutes' => 60,
                'capacity' => 3,
                'sloting_minutes' => 60,
                'sloting_break' => 10,
                'booking_capacity_days' => 7,
            ],
            [
                'name' => "Hair Coloring",
                'duration_minutes' => 120,
                'capacity' => 3,
                'sloting_minutes' => 60,
                'sloting_break' => 15,
                'booking_capacity_days' => 7,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
