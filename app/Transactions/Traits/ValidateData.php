<?php

namespace App\Transactions\Traits;

use App\Exceptions\TransactionException;
use App\Transactions\TransactionValidador;

trait ValidateData
{
    protected function validateData()
    {
        $validador = new TransactionValidador();
        $erros = [];

        $this->validate($validador, $erros);

        if (count($erros) > 0)
            throw new TransactionException($erros);
    }

    abstract protected function validate(TransactionValidador $validador, array &$erros);
}

?>