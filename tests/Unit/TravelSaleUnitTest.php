<?php

namespace Tests\Unit;

use App\Models\TravelSale;
use App\Transactions\TravelSale\AddTravelSaleTransaction;
use Tests\TestCase;

class TravelSaleUnitTest extends TestCase
{
    private $price = 219.98;

    public function testAddTravelSaleWithoutUser()
    {
        $busChair = $this->createBusChair();
        $bus = $busChair->bus;
        $travel = $this->createTravel();
        $customer = $this->createCustomer();

        $transaction = new AddTravelSaleTransaction($this->price, $travel->id, $busChair->id, $bus->id, $customer->id);
        $transaction->execute();

        $travelSale = TravelSale::first();

        $this->assertNotNull($travelSale, 'Venda viagem inválida');
        $this->assertNotNull($travelSale->uuid, 'UUID inválido');
        $this->assertEquals($this->price, $travelSale->price, 'Preco incorreto');
        $this->assertEquals($bus->id, $travelSale->bus->id, 'Preco incorreto');
        $this->assertEquals($bus->id, $travelSale->bus->id, 'Ônibus incorreto');
        $this->assertEquals($travel->id, $travelSale->travel->id, 'Viagem incorreta');
        $this->assertEquals($customer->id, $travelSale->customer->id, 'Cliente incorreto');
        $this->assertEquals($busChair->id, $travelSale->busChair->id, 'Poltrona do ônibus incorreto');

    }

    public function testAddTravelSaleWithUser()
    {
        $busChair = $this->createBusChair();
        $bus = $busChair->bus;
        $travel = $this->createTravel();
        $customer = $this->createCustomer();
        $user = $this->createUser();

        $transaction = new AddTravelSaleTransaction($this->price, $travel->id, $busChair->id, $bus->id, $customer->id, $user->id);
        $transaction->execute();
        
        $travelSale = TravelSale::first();
        
        $this->assertNotNull($travelSale, 'Venda viagem inválida');
        $this->assertNotNull($travelSale->uuid, 'UUID inválido');
        $this->assertEquals($this->price, $travelSale->price, 'Preco incorreto');
        $this->assertEquals($bus->id, $travelSale->bus->id, 'Preco incorreto');
        $this->assertEquals($bus->id, $travelSale->bus->id, 'Ônibus incorreto');
        $this->assertEquals($travel->id, $travelSale->travel->id, 'Viagem incorreta');
        $this->assertEquals($customer->id, $travelSale->customer->id, 'Cliente incorreto');
        $this->assertEquals($user->id, $travelSale->user->id, 'Usuário incorreto');
        $this->assertEquals($busChair->id, $travelSale->busChair->id, 'Poltrona do ônibus incorreto');
    }

    // public function testUpdateTravelSale()
    // {
    //     $busChair = $this->createBusChair();
    //     $bus = $busChair->bus;
    //     $travel = $this->createTravel();
    //     $customer = $this->createCustomer();
    //     $user = $this->createUser();

    //     $transaction = new AddTravelSaleTransaction($this->price, $travel->id, $busChair->id, $bus->id, $customer->id, $user->id);
    //     $transaction->execute();
        
    //     $travelSale = TravelSale::first();
        
    //     $this->assertNotNull($travelSale, 'Venda viagem inválida');
    //     $this->assertNotNull($travelSale->uuid, 'UUID inválido');
    //     $this->assertEquals($this->price, $travelSale->price, 'Preco incorreto');
    //     $this->assertEquals($bus->id, $travelSale->bus->id, 'Preco incorreto');
    //     $this->assertEquals($bus->id, $travelSale->bus->id, 'Ônibus incorreto');
    //     $this->assertEquals($travel->id, $travelSale->travel->id, 'Viagem incorreta');
    //     $this->assertEquals($customer->id, $travelSale->customer->id, 'Cliente incorreto');
    //     $this->assertEquals($user->id, $travelSale->user->id, 'Usuário incorreto');
    //     $this->assertEquals($busChair->id, $travelSale->busChair->id, 'Poltrona do ônibus incorreto');
    // }

}
