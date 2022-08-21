<?php

namespace Tests\Unit;

use App\Models\Customer;
use App\Transactions\Customer\AddCustomerTransaction;
use Tests\TestCase;

class CustomerUnitTest extends TestCase
{
    private $name = 'Cliente de Teste Souza Oliveira';
    private $email = 'clientedeteste@hotmail.com.br';
    private $password = 'TeSteDeSenhaFoRtE123@%!"+(45(SsAaZz):;/.,zZXsAWQ=_-';
    private $phone = '+5528999007760';

    public function testAddCustomer()
    {
        $city = $this->createCity();

        $transaction = new AddCustomerTransaction($this->name, $this->email, $this->password, $this->phone, $city->id);
        $transaction->execute();

        $customer = Customer::first();

        $this->assertNotNull($customer, 'Cliente inválido');
        $this->assertNotNull($customer->uuid, 'UUID inválido');
        $this->assertEquals($this->name, $customer->name, 'Nome incorreto');
        $this->assertEquals($this->email, $customer->email, 'Email incorreto');
        $this->assertTrue($customer->validatePassword($this->password), 'Senha do usuário incorreta');
        $this->assertEquals($city->id, $customer->city->id, 'Cidade incorreta');
    } 
}
