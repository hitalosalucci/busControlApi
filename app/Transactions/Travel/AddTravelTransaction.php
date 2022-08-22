<?php

namespace App\Transactions\Travel;

use App\Models\City;
use App\Models\Driver;
use App\Models\Travel;
use App\Transactions\Transaction;
use App\Transactions\Traits\ValidateData;
use App\Transactions\TransactionValidador;
use DateTime;
use Illuminate\Support\Facades\Hash;

class AddTravelTransaction implements Transaction
{
    use ValidateData;

    public function __construct(string $name, string $date, int $originId, int $destinationId, int $busId)
    {
        $this->name = $name;
        $this->date = $date;
        $this->originId = $originId;
        $this->destinationId = $destinationId;
        $this->busId = $busId;
    }

    public function execute()
    {

        $this->validateData();

        $travel = new Travel();
        $travel->name = $this->name;
        $travel->date = $this->date;
        $travel->origin_id = $this->originId;
        $travel->destination_id = $this->destinationId;
        $travel->bus_id = $this->busId;

        $travel->save();
    }

    protected function validate(TransactionValidador $validador, array &$errors)
    {
        $validador->textoVazio($this->name, 'name', $errors);
        $validador->textoVazio($this->date, 'date', $errors);
        $validador->textoVazio($this->originId, 'originId', $errors);
        $validador->textoVazio($this->destinationId, 'destinationId', $errors);
        $validador->textoVazio($this->busId, 'busId', $errors);
    }
}
