<?php

namespace App\Transactions\Origin;

use App\Models\City;
use App\Models\Origin;
use App\Transactions\Transaction;
use App\Transactions\Traits\ValidateData;
use App\Transactions\TransactionValidador;

class AddOriginTransaction implements Transaction
{
    use ValidateData;

    public function __construct(int $cityId)
    {
        $this->cityId = $cityId;
    }

    public function execute()
    {
        $this->validateData();

        $origin = new Origin();
        $origin->city_id = $this->cityId;

        $origin->save();
    }

    protected function validate(TransactionValidador $validador, array &$errors)
    {
        $validador->objetoInexistente(new City(), $this->cityId, 'city', $errors);
    }
}
