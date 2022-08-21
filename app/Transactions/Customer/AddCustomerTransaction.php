<?php

namespace App\Transactions\Customer;

use App\Models\City;
use App\Models\Customer;
use App\Transactions\Transaction;
use App\Transactions\Traits\ValidateData;
use App\Transactions\TransactionValidador;
use Illuminate\Support\Facades\Hash;

class AddCustomerTransaction implements Transaction
{
    use ValidateData;

    public function __construct(string $name, string $email, string $password, string $phone, int $cityId)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->phone = $phone;
        $this->cityId = $cityId;
    }

    public function execute()
    {
        $this->validateData();

        $customer = new Customer();
        $customer->name = $this->name;
        $customer->email = $this->email;
        $customer->password = Hash::make($this->password);
        $customer->phone = $this->phone;
        $customer->city_id = $this->cityId;

        $customer->save();
    }

    protected function validate(TransactionValidador $validador, array &$errors)
    {
        $validador->textoVazio($this->name, 'name', $errors);
        $validador->textoVazio($this->email, 'email', $errors);
        $validador->textoVazio($this->password, 'password', $errors);
        $validador->textoVazio($this->phone, 'phone', $errors);
        $validador->objetoInexistente(new City(), $this->cityId, 'city', $errors);
    }
}
