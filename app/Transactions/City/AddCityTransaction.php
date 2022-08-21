<?php

namespace App\Transactions\City;

use App\Models\City;
use App\Models\State as ModelsState;
use App\Transactions\Transaction;
use App\Transactions\Traits\ValidateData;
use App\Transactions\TransactionValidador;

class AddCityTransaction implements Transaction
{
    use ValidateData;

    public function __construct(string $name, string $cep, int $stateId)
    {
        $this->name = $name;
        $this->cep = $cep;
        $this->stateId = $stateId;
    }

    public function execute()
    {
        $this->validateData();

        $city = new City();
        $city->name = $this->name;
        $city->cep = $this->cep;
        $city->state_id = $this->stateId;
        
        $city->save();
    }

    protected function validate(TransactionValidador $validador, array &$errors)
    {
        $validador->textoVazio($this->name, 'name', $errors);
        $validador->textoVazio($this->cep, 'cep', $errors);
        $validador->objetoInexistente(new ModelsState(), $this->stateId, 'state', $errors);
    }
}
