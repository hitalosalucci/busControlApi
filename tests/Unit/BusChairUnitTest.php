<?php

namespace Tests\Unit;

use App\Models\BusChair;
use App\Transactions\BusChair\AddBusChairTransaction;
use Tests\TestCase;

class BusChairUnitTest extends TestCase
{
    private $number = 36;
    private $code = 'A36';
    
    public function testAddBusChair()
    {
        
        $bus = $this->createBus();

        $transaction = new AddBusChairTransaction($this->number, $this->code, $bus->id);
        $transaction->execute();

        $busChair = BusChair::first();

        $this->assertNotNull($busChair, 'Estado inválido');
        $this->assertEquals($this->number, $busChair->number, 'Nome iconrreto');
        $this->assertEquals($this->code, $busChair->code, 'Sigla incorreta');
        $this->assertEquals($bus->id, $busChair->bus->id, 'Ônibus incorreto');
    }
}



