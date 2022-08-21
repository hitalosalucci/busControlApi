<?php

namespace Tests\Unit;

use App\Models\City;
use App\Transactions\City\AddCityTransaction;
use Tests\TestCase;

class CityUnitTest extends TestCase
{
    private $cityName = 'Cidade de teste';
    private $cityCep = '29550000';

    public function testAddCity()
    {
        $state = $this->createState();

        $transaction = new AddCityTransaction($this->cityName, $this->cityCep, $state->id);
        $transaction->execute();

        $city = City::first();

        $this->assertNotNull($city, 'Cidade inválida');
        $this->assertEquals($this->cityName, $city->name, 'Nome incorreto');
        $this->assertEquals($this->cityCep, $city->cep, 'CEP incorreto');
        $this->assertEquals($state->id, $city->state->id, 'Estado incorreto');
    } 

}
