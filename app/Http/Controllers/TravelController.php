<?php

namespace App\Http\Controllers;

use App\Models\Travel;
use Illuminate\Http\Request;

class TravelController extends Controller
{
    public function getAllTravels()
    {
        $travels = Travel::all();

        $travelArray = [];
        foreach ($travels as $travel)
        {
            $travelArray[] = [
                'uuid' => $travel->uuid,
                'name' => $travel->name,
                'date' => $travel->date,
                'origin' => [
                    'data' => $travel->origin,
                    'city' => $travel->origin->city
                ],
                'destination' => [
                    'data' => $travel->destination,
                    'city' => $travel->destination->city
                ],
                'bus' => $travel->bus,
                'driver' => $travel->driver,
                'created_at' => $travel->created_at,
            ];
        }

        $returnArray = [
            'status' => 200,
            'error' => false,
            'data' => $travelArray
        ];

        return $returnArray;
    }
}
