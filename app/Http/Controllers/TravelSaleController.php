<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\BusChair;
use App\Models\Customer;
use App\Models\Travel;
use App\Models\TravelSale;
use App\Models\User;
use App\Transactions\TravelSale\AddTravelSaleTransaction;
use Exception;
use Illuminate\Http\Request;

class TravelSaleController extends Controller
{
    public function getAllTravelSales()
    {
        $travelSales = TravelSale::all();

        $travelSalesArray = [];
        foreach ($travelSales as $sale)
        {
            $travelSalesArray[] = [
                'uuid' => $sale->uuid,
                'price' => $sale->price,
                'travel' => $sale->travel,
                'origem' => $sale->travel->origin->city,
                'destination' => $sale->travel->destination->city,
                'bus' => $sale->bus,
                'bus_chair' => $sale->busChair,
                'customer' => $sale->customer
            ];
        }

        $returnArray = [
            'status' => 200,
            'error' => false,
            'data' => $travelSalesArray
        ];

        return $returnArray;
    }

    public function getTravelSalesPerBusUuid(Request $request)
    {
        $bus = Bus::where('uuid', $request->uuid)->first();
        $travelSales = TravelSale::where('bus_id', $bus->id)->get();
        

        $travelSalesArray = [];
        foreach ($travelSales as $sale)
        {
            $travelSalesArray[] = [
                'uuid' => $sale->uuid,
                'price' => $sale->price,
                'travel' => $sale->travel,
                'origem' => $sale->travel->origin->city,
                'destination' => $sale->travel->destination->city,
                'bus' => $sale->bus,
                'bus_chair' => $sale->busChair,
                'customer' => $sale->customer
            ];
        }

        $returnArray = [
            'status' => 200,
            'error' => false,
            'data' => $travelSalesArray
        ];

        return $returnArray;
    }

    public function getTravelSalePerUuid(Request $request)
    {

        $travelSale = TravelSale::where('uuid', $request->uuid)->first();

        $travelSaleArray = [];
        
        if ( !is_null($travelSale) ){ 
            $travelSaleArray = [
                'uuid' => $travelSale->uuid,
                'price' => $travelSale->price,
                'travel' => $travelSale->travel,
                'origem' => $travelSale->travel->origin->city,
                'destination' => $travelSale->travel->destination->city,
                'bus' => $travelSale->bus,
                'bus_chair' => $travelSale->busChair,
                'customer' => $travelSale->customer
            ];
        }

        $returnArray = [
            'status' => 200,
            'error' => false,
            'data' => $travelSaleArray
        ];

        return $returnArray;
    }

    public function addTravelSale(Request $request)
    {

        $price = $request->price;

        $fields_fail = [];

        $travelModel = new Travel();
        $travel = $travelModel->findPerUuid($request->travel);

        if (is_null($travel))
            $fields_fail[] = 'travel';

        $busChairModel = new BusChair();
        $busChair = $busChairModel->findPerUuid($request->bus_chair);

        if (is_null($travel))
            $fields_fail[] = 'bus_chair';
        
        $customerModel = new Customer();
        $customer = $customerModel->findPerUuid($request->customer);

        if (is_null($travel))
            $fields_fail[] = 'customer';

        $userModel = new User();
        $user = $userModel->findPerUuid($request->user);

        is_null($user) ? $userId = null : $userId = $user->id; 

        $error = true;
        $exception = false;
        if (empty($fields_fail)){
            
            try {
                $transaction = new AddTravelSaleTransaction($price, $travel->id, $busChair->id, $busChair->bus->id, $customer->id, $userId);
                $transaction->execute();

                $error = false;
            } 
            catch(Exception $e){
                $exception = $e->getMessage();
            }

        }
        
        $returnArray = [
            'status' => 200,
            'error' => $error,
            'fields_fail' => $fields_fail,
            'exception' => $exception
        ];

        return $returnArray;
    }

    public function deleteTravelSale(Request $request)
    {
        $travelSale = TravelSale::where('uuid', $request->uuid)->first();
        
        $error = true;
        $exception = false;

        try {
            $travelSale->delete();

            $error = false;
        } 
        catch(Exception $e){
            $exception = $e->getMessage();
        }

        $returnArray = [
            'status' => 200,
            'error' => $error,
            'exception' => $exception
        ];

        return $returnArray;
    }
}
