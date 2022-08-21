<?php

namespace App\Transactions\State;

use App\Models\State as ModelsState;
use App\Transactions\Transaction;
use App\Transactions\Traits\ValidateData;
use App\Transactions\TransactionValidador;

class AddStateTransaction implements Transaction
{
    use ValidateData;

    public function __construct(string $name, string $acronym)
    {
        $this->name = $name;
        $this->acronym = $acronym;
    }

    public function execute()
    {
        $this->validateData();

        $state = new ModelsState();
        $state->name = $this->name;
        $state->acronym = $this->acronym;

        $state->save();
    }

    protected function validate(TransactionValidador $validador, array &$errors)
    {
        $validador->textoVazio($this->name, 'name', $errors);
        $validador->textoVazio($this->acronym, 'acronym', $errors);
    }
}
