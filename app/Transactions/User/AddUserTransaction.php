<?php

namespace App\Transactions\User;

use App\Models\User;
use App\Transactions\Transaction;
use App\Transactions\Traits\ValidateData;
use App\Transactions\TransactionValidador;
use Illuminate\Support\Facades\Hash;

class AddUserTransaction implements Transaction
{
    use ValidateData;

    public function __construct(string $name, string $login, string $email, string $password, string $level)
    {
        $this->name = $name;
        $this->login = $login;
        $this->email = $email;
        $this->password = $password;
        $this->level = $level;
    }

    public function execute()
    {
        $statusDefault = 'active';

        $this->validateData();

        $customer = new User();
        $customer->name = $this->name;
        $customer->login = $this->login;
        $customer->email = $this->email;
        $customer->password = Hash::make($this->password);
        $customer->status = $statusDefault;
        $customer->level = $this->level;

        $customer->save();
    }

    protected function validate(TransactionValidador $validador, array &$errors)
    {
        $validador->textoVazio($this->name, 'name', $errors);
        $validador->textoVazio($this->login, 'login', $errors);
        $validador->textoVazio($this->email, 'email', $errors);
        $validador->textoVazio($this->password, 'password', $errors);
        $validador->textoVazio($this->level, 'level', $errors);
    }
}
