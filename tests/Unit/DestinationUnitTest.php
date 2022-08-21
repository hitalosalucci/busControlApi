<?php

namespace Tests\Unit;

use App\Models\Destination;
use App\Transactions\Destination\AddDestinationTransaction;
use Tests\TestCase;

class DestinationUnitTest extends TestCase
{
    public function testAddDestination()
    {
        $city = $this->createCity();

        $transaction = new AddDestinationTransaction($city->id);
        $transaction->execute();

        $origin = Destination::first();

        $this->assertNotNull($origin, 'Destino inválido');
        $this->assertNotNull($origin->uuid, 'UUID inválido');
        $this->assertEquals($city->id, $origin->city->id, 'Cidade incorreta');
    }
}
