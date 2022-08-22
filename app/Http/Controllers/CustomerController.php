<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function getAllCustomers()
    {
     
        $customers = Customer::all();

        $customerArray = [];
        foreach ($customers as $customer)
        {
            $customerArray[] = [
                'uuid' => $customer->uuid,
                'name' => $customer->name,
                'phone' => $customer->phone,
                'email' => $customer->email,
                'created_at' => $customer->created_at,
                'city' => $customer->city,
            ];
        }

        $returnArray = [
            'status' => 200,
            'error' => false,
            'data' => $customerArray
        ];

        return $returnArray;
    }
}
