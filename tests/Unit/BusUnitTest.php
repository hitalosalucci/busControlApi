<?php

namespace Tests\Unit;

use App\Models\Bus;
use App\Transactions\Bus\AddBusTransaction;
use Tests\TestCase;

class BusUnitTest extends TestCase
{
    private $manufacturer = 'Mercedes-Benz';
    private $model = 'MB1-VH020403';
    private $code = '8190310001';
    private $description = 'Ônibus usado linhas blablabla asdkasdasd  asdasd asdasdasd asdasdasdqweqwea asdqweqweqweqweqsad qweqweqweqwesd asdasdasdasdasdqw sd qsdasdas asdasdasdasdasdsasdaqwqwdq asidaosdinasodn tesasdas @ 34123@!@#!@# asdasdksndasodjbn';
    private $color = 'Branco';

    public function testAddBus()
    {

        $transaction = new AddBusTransaction($this->manufacturer, $this->model, $this->code, $this->description, $this->color);
        $transaction->execute();

        $bus = Bus::first();

        $this->assertNotNull($bus, 'Ônibus inválido');
        $this->assertEquals($this->manufacturer, $bus->manufacturer, 'Fabricante incorreto');
        $this->assertEquals($this->model, $bus->model, 'Modelo incorreto');
        $this->assertEquals($this->code, $bus->code, 'Codigo incorreto');
        $this->assertEquals($this->description, $bus->description, 'Descricao incorreta');
        $this->assertEquals($this->color, $bus->color, 'Cor incorreta');
    } 
}
