<?php

namespace App\Transactions\PopuleDb;

use App\Models\Bus;
use App\Transactions\BusChair\AddBusChairTransaction;
use App\Transactions\Transaction;

class PopuleBusChairsTransaction implements Transaction
{
    public function execute()
    {

        $buses = Bus::all();

        foreach ($buses as $bus){

            for ($i=1; $i <= 45; $i++) { 
                $t = new AddBusChairTransaction($i, rand(1000, 9999), $bus->id);
                $t->execute();
            }
        }
    }
}
