<?php

namespace App\Transactions\Bus;

use App\Models\Bus;
use App\Transactions\Transaction;
use App\Transactions\Traits\ValidateData;
use App\Transactions\TransactionValidador;
use Illuminate\Support\Facades\Hash;

class AddBusTransaction implements Transaction
{
    use ValidateData;

    public function __construct(string $manufacturer, string $model, string $code, string $description, string $color)
    {
        $this->manufacturer = $manufacturer;
        $this->model = $model;
        $this->code = $code;
        $this->description = $description; 
        $this->color = $color;
    }

    public function execute()
    {
        $this->validateData();

        $bus = new Bus();
        $bus->manufacturer = $this->manufacturer;
        $bus->model = $this->model;
        $bus->code = $this->code;
        $bus->description = $this->description;
        $bus->color = $this->color;

        $bus->save();
    }

    protected function validate(TransactionValidador $validador, array &$errors)
    {
        $validador->textoVazio($this->manufacturer, 'manufacturer', $errors);
        $validador->textoVazio($this->model, 'model', $errors);
        $validador->textoVazio($this->code, 'code', $errors);
        $validador->textoVazio($this->description, 'description', $errors);
        $validador->textoVazio($this->color, 'color', $errors);
    }
}
