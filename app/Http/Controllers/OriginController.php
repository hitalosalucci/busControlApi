<?php

namespace App\Http\Controllers;

use App\Models\Origin;
use Illuminate\Http\Request;

class OriginController extends Controller
{
    public function getAllOrigins()
    {
        $origins = Origin::all();

        $originArray = [];
        foreach ($origins as $origin)
        {
            $originArray[] = [
                'uuid' => $origin->uuid,
                'city' => $origin->city,
                'state' => $origin->state,
            ];
        }

        $returnArray = [
            'status' => 200,
            'error' => false,
            'data' => $originArray
        ];

        return $returnArray;
    }
}
