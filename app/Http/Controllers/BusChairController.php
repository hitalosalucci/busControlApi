<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\BusChair;
use Illuminate\Http\Request;

class BusChairController extends Controller
{
    public function getAllChairsPerBusUuid(Request $request)
    {
        $bus = Bus::where('uuid', $request->uuid)->first();
        $busChairs = BusChair::where('bus_id', $bus->id)->get();

        $busChairArray = [];
        foreach ($busChairs as $busChair)
        {
            $busChairArray[] = [
                'uuid' => $busChair->uuid,
                'number' => $busChair->number,
                'code' => $busChair->code,
                'bus' => $busChair->bus,
                'created_at' => $busChair->created_at,
            ];
        }

        $returnArray = [
            'status' => 200,
            'error' => false,
            'data' => $busChairArray
        ];

        return $returnArray;
    }
}
