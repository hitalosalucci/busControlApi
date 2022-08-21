<?php

namespace App\Transactions\Destination;

use App\Models\City;
use App\Models\Destination;
use App\Transactions\Transaction;
use App\Transactions\Traits\ValidateData;
use App\Transactions\TransactionValidador;

class AddDestinationTransaction implements Transaction
{
    use ValidateData;

    public function __construct(int $cityId)
    {
        $this->cityId = $cityId;
    }

    public function execute()
    {
        $this->validateData();

        $destination = new Destination();
        $destination->city_id = $this->cityId;

        $destination->save();
    }

    protected function validate(TransactionValidador $validador, array &$errors)
    {
        $validador->objetoInexistente(new City(), $this->cityId, 'city', $errors);
    }
}
