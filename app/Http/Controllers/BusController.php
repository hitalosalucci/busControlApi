<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use Illuminate\Http\Request;

class BusController extends Controller
{
    public function getAllBuses()
    {
        $buses = Bus::all();

        $busArray = [];
        foreach ($buses as $bus)
        {
            $busArray[] = [
                'uuid' => $bus->uuid,
                'description' => $bus->description,
                'model' => $bus->model,
                'manufacturer' => $bus->manufacturer,
                'created_at' => $bus->created_at,
            ];
        }

        $returnArray = [
            'status' => 200,
            'error' => false,
            'data' => $busArray
        ];

        return $returnArray;
    }
}
