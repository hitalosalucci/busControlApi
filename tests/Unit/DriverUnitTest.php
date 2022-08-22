<?php

namespace Tests\Unit;

use App\Models\Driver;
use App\Transactions\Driver\AddDriverTransaction;
use Tests\TestCase;

class DriverUnitTest extends TestCase
{
    private $name = 'Motorista de Teste Ferreira Oliveira';
    private $email = 'motoristadeteste@aguiabranca.com';
    private $password = 'TeSteDeSenhaFoRtE123@%!"+(45(SsAaZz):;/.,zZXsAWQ=_-';
    private $cnh = '001281326090';
    private $cpf = '00816709612';
    private $rg = '2082028122';

    public function testAddDriver()
    {

        $transaction = new AddDriverTransaction($this->name, $this->email, $this->password, $this->cnh, $this->cpf, $this->rg);
        $transaction->execute();

        $driver = Driver::first();

        $this->assertNotNull($driver, 'Motorista inválido');
        $this->assertNotNull($driver->uuid, 'UUID inválido');
        $this->assertEquals($this->name, $driver->name, 'Nome incorreto');
        $this->assertEquals($this->email, $driver->email, 'Email incorreto');
        $this->assertEquals($this->cnh, $driver->cnh, 'CNH incorreto');
        $this->assertEquals($this->cpf, $driver->cpf, 'CPF incorreto');
        $this->assertEquals($this->rg, $driver->rg, 'RG incorreto');
        $this->assertTrue($driver->validatePassword($this->password), 'Senha do usuário incorreta');
    } 
}
