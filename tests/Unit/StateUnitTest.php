<?php

namespace Tests\Unit;

use App\Models\State;
use App\Transactions\State\AddStateTransaction;
use Tests\TestCase;

class StateUnitTest extends TestCase
{
    private $name = 'Estado de teste';
    private $acronym = 'TE';
    
    public function testAddState()
    {
        $transaction = new AddStateTransaction($this->name, $this->acronym);
        $transaction->execute();

        $state = State::first();

        $this->assertNotNull($state, 'Estado inválido');
        $this->assertEquals($this->name, $state->name, 'Nome iconrreto');
        $this->assertEquals($this->acronym, $state->acronym, 'Sigla incorreta');
    }
}
