<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function getAllDrivers()
    {
        $drivers = Driver::all();

        $driverArray = [];
        foreach ($drivers as $driver)
        {
            $driverArray[] = [
                'uuid' => $driver->uuid,
                'name' => $driver->name,
                'cpf' => $driver->cpf,
                'rg' => $driver->rg,
                'cnh' => $driver->cnh,
                'email' => $driver->email,
                'status' => $driver->status,
                'created_at' => $driver->created_at,
            ];
        }

        $returnArray = [
            'status' => 200,
            'error' => false,
            'data' => $driverArray
        ];

        return $returnArray;
    }
}
