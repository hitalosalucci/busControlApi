<?php

namespace App\Transactions\Driver;

use App\Models\City;
use App\Models\Driver;
use App\Transactions\Transaction;
use App\Transactions\Traits\ValidateData;
use App\Transactions\TransactionValidador;
use Illuminate\Support\Facades\Hash;

class AddDriverTransaction implements Transaction
{
    use ValidateData;

    public function __construct(string $name, string $email, string $password, string $cnh, string $cpf, string $rg)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->cnh = $cnh;
        $this->cpf = $cpf;
        $this->rg = $rg;
    }

    public function execute()
    {
        $statusDefault = 'active';

        $this->validateData();

        $driver = new Driver();
        $driver->name = $this->name;
        $driver->cnh = $this->cnh;
        $driver->cpf = $this->cpf;
        $driver->rg = $this->rg;
        $driver->email = $this->email;
        $driver->password = Hash::make($this->password);
        $driver->status = $statusDefault;

        $driver->save();
    }

    protected function validate(TransactionValidador $validador, array &$errors)
    {
        $validador->textoVazio($this->name, 'name', $errors);
        $validador->textoVazio($this->email, 'email', $errors);
        $validador->textoVazio($this->password, 'password', $errors);
        $validador->textoVazio($this->cnh, 'cnh', $errors);
        $validador->textoVazio($this->cpf, 'cpf', $errors);
        $validador->textoVazio($this->rg, 'rg', $errors);
    }
}
