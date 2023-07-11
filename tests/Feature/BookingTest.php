<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookingTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_booking_holiday()
    {
        $response = $this->post('/api/bookings', [
            'date' => "2023-07-16",
            "service_id" => 1,
            "time_start" => "18:30",
            "time_end" => "19:00",
            "customers" => [
                [
                    "first_name" => "irfan",
                    "last_name" => "mumtaz",
                    "email" => "irfan.mumtaz@gmail.com"
                ]
            ]
        ]);

        $response->assertStatus(422);
    }

    public function test_booking_future_cap()
    {
        $response = $this->post('/api/bookings', [
            'date' => "2023-09-16",
            "service_id" => 1,
            "time_start" => "18:30",
            "time_end" => "19:00",
            "customers" => [
                [
                    "first_name" => "irfan",
                    "last_name" => "mumtaz",
                    "email" => "irfan.mumtaz@gmail.com"
                ]
            ]
        ]);

        $response->assertStatus(422);
    }
    
    public function test_booking_non_working()
    {
        $response = $this->post('/api/bookings', [
            'date' => date("Y-m-d"),
            "service_id" => 1,
            "time_start" => "07:00",
            "time_end" => "07:30",
            "customers" => [
                [
                    "first_name" => "irfan",
                    "last_name" => "mumtaz",
                    "email" => "irfan.mumtaz@gmail.com"
                ]
            ]
        ]);

        $response->assertStatus(422);
    }
    
    public function test_booking_duration_more_than_allowed()
    {
        $response = $this->post('/api/bookings', [
            'date' => date("Y-m-d"),
            "service_id" => 1,
            "time_start" => "09:00",
            "time_end" => "10:30",
            "customers" => [
                [
                    "first_name" => "irfan",
                    "last_name" => "mumtaz",
                    "email" => "irfan.mumtaz@gmail.com"
                ]
            ]
        ]);

        $response->assertStatus(422);
    }
    
    public function test_booking_public_off()
    {
        $response = $this->post('/api/bookings', [
            'date' => "2023-07-12",
            "service_id" => 1,
            "time_start" => "09:00",
            "time_end" => "10:30",
            "customers" => [
                [
                    "first_name" => "irfan",
                    "last_name" => "mumtaz",
                    "email" => "irfan.mumtaz@gmail.com"
                ]
            ]
        ]);

        $response->assertStatus(422);
    }
    
    public function test_booking_lunch_time()
    {
        $response = $this->post('/api/bookings', [
            'date' => "2023-07-15",
            "service_id" => 1,
            "time_start" => "12:00",
            "time_end" => "12:30",
            "customers" => [
                [
                    "first_name" => "irfan",
                    "last_name" => "mumtaz",
                    "email" => "irfan.mumtaz@gmail.com"
                ]
            ]
        ]);

        $response->assertStatus(422);
    }
    
    public function test_booking_cleaning_break()
    {
        $response = $this->post('/api/bookings', [
            'date' => "2023-07-15",
            "service_id" => 1,
            "time_start" => "15:00",
            "time_end" => "15:30",
            "customers" => [
                [
                    "first_name" => "irfan",
                    "last_name" => "mumtaz",
                    "email" => "irfan.mumtaz@gmail.com"
                ]
            ]
        ]);

        $response->assertStatus(422);
    }
    
    public function test_booking_fully_booked()
    {
        $response = $this->post('/api/bookings', [
            'date' => "2023-07-11",
            "service_id" => 1,
            "time_start" => "18:10",
            "time_end" => "18:40",
            "customers" => [
                [
                    "first_name" => "irfan",
                    "last_name" => "mumtaz",
                    "email" => "irfan.mumtaz@gmail.com"
                ]
            ]
        ]);

        $response->assertStatus(422);
    }
    
    public function test_booking_invalid_slot()
    {
        $response = $this->post('/api/bookings', [
            'date' => "2023-07-11",
            "service_id" => 1,
            "time_start" => "18:03",
            "time_end" => "18:43",
            "customers" => [
                [
                    "first_name" => "irfan",
                    "last_name" => "mumtaz",
                    "email" => "irfan.mumtaz@gmail.com"
                ]
            ]
        ]);

        $response->assertStatus(422);
    }
    
    public function test_booking_success()
    {
        $response = $this->post('/api/bookings', [
            'date' => "2023-07-13",
            "service_id" => 1,
            "time_start" => "09:10",
            "time_end" => "09:40",
            "customers" => [
                [
                    "first_name" => "irfan",
                    "last_name" => "mumtaz",
                    "email" => "irfan.mumtaz@gmail.com"
                ]
            ]
        ]);

        $response->assertStatus(422);
    }
}
