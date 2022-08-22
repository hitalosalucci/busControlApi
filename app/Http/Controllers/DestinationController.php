<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function getAllDestinations()
    {
        $destinations = Destination::all();

        $destinationArray = [];
        foreach ($destinations as $destination)
        {
            $destinationArray[] = [
                'uuid' => $destination->uuid,
                'city' => $destination->city,
                'state' => $destination->state,
            ];
        }

        $returnArray = [
            'status' => 200,
            'error' => false,
            'data' => $destinationArray
        ];

        return $returnArray;
    }
}
