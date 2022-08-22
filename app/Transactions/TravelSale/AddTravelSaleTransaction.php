<?php

namespace App\Transactions\TravelSale;

use App\Models\TravelSale;
use App\Transactions\Transaction;
use App\Transactions\Traits\ValidateData;
use App\Transactions\TransactionValidador;

class AddTravelSaleTransaction implements Transaction
{
    use ValidateData;

    public function __construct(float $price, int $travelId, int $busChairId, int $busId, int $customerId, int $userId = null)
    {
        $this->price = $price;
        $this->travelId = $travelId;
        $this->busChairId = $busChairId;
        $this->busId = $busId;
        $this->userId = $userId;
        $this->customerId = $customerId;
    }

    public function execute()
    {

        $this->validateData();
        
        $travelSale = new TravelSale();

        $travelSale->price = $this->price;
        $travelSale->travel_id = $this->travelId;
        $travelSale->bus_chair_id = $this->busChairId;
        $travelSale->bus_id = $this->busId;
        $travelSale->user_id = $this->userId;
        $travelSale->customer_id = $this->customerId;

        $travelSale->save();
    }

    protected function validate(TransactionValidador $validador, array &$errors)
    {
        $validador->textoVazio($this->busChairId, 'bus_chair', $errors);
        $validador->busChairUsed($this->busChairId, new TravelSale(), 'bus_chair', $errors);
        $validador->textoVazio($this->price, 'price', $errors);
        $validador->textoVazio($this->travelId, 'travel', $errors);
        $validador->textoVazio($this->customerId, 'customer', $errors);
    }
}
