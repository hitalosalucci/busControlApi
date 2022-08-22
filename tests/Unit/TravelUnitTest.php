<?php

namespace Tests\Unit;

use App\Models\Travel;
use App\Transactions\Travel\AddTravelTransaction;
use DateTime;
use Tests\TestCase;

class TravelUnitTest extends TestCase
{
    private $name = 'Viagem VIX X Cachoeiro de Itapemirim';
    
    public function testAddTravel()
    {
        $date = '2022-04-23 12:30:19';
        $bus = $this->createBus();
        $origin = $this->createOrigin();
        $destination = $this->createDestination();

        $transaction = new AddTravelTransaction($this->name, $date, $origin->id, $destination->id, $bus->id);
        $transaction->execute();

        $travel = Travel::first();

        $this->assertNotNull($travel, 'Viagem inválido');
        $this->assertNotNull($travel->uuid, 'UUID inválido');
        $this->assertEquals($this->name, $travel->name, 'Nome incorreto');
        $this->assertEquals($date, $travel->date, 'Data incorreta');
        $this->assertEquals($bus->id, $travel->bus->id, 'Ônibus incorreto');
        $this->assertEquals($origin->id, $travel->origin->id, 'Origem incorreta');
        $this->assertEquals($destination->id, $travel->destination->id, 'Destino incorreto');

    }

}
