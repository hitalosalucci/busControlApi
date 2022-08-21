<?php

namespace App\Transactions\BusChair;

use App\Models\BusChair;
use App\Transactions\Transaction;
use App\Transactions\Traits\ValidateData;
use App\Transactions\TransactionValidador;

class AddBusChairTransaction implements Transaction
{
    use ValidateData;

    public function __construct(int $number, string $code, int $busId)
    {
        $this->number = $number;
        $this->code = $code;
        $this->busId = $busId;
    }

    public function execute()
    {
        $this->validateData();

        $bus = new BusChair();
        $bus->number = $this->number;
        $bus->code = $this->code;
        $bus->bus_id = $this->busId;

        $bus->save();
    }

    protected function validate(TransactionValidador $validador, array &$errors)
    {
        $validador->textoVazio($this->number, 'number', $errors);
        $validador->textoVazio($this->code, 'code', $errors);
    }
}
