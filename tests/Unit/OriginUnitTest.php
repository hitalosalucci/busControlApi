<?php

namespace Tests\Unit;

use App\Models\Origin;
use App\Transactions\Origin\AddOriginTransaction;
use Tests\TestCase;

class OriginUnitTest extends TestCase
{
    
    public function testAddOrigin()
    {
        $city = $this->createCity();

        $transaction = new AddOriginTransaction($city->id);
        $transaction->execute();

        $origin = Origin::first();

        $this->assertNotNull($origin, 'Origem inválido');
        $this->assertNotNull($origin->uuid, 'UUID inválido');
        $this->assertEquals($city->id, $origin->city->id, 'Cidade incorreta');
    }
}
