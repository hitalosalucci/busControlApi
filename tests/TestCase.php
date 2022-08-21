<?php

namespace Tests;

use App\Exceptions\TransactionException;
use App\Models\City;
use App\Models\State;
use App\Transactions\City\AddCityTransaction;
use App\Transactions\State\AddStateTransaction;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use RefreshDatabase;

    protected $faker;

    protected function setUp() : void
    {
        parent::setUp();

        $this->faker = Factory::create();
    }

    protected function assertErrorTransaction(TransactionException $exception, string $field, string $expectedError)
    {
        $erros = $exception->getErrors();
        $this->assertTrue(isset($erros[$field]), 'Faltando campo "'.$field.'" em exceção');
        $this->assertEquals($expectedError, $erros[$field], 'Erro do campo "'.$field.'" incorreto');
    }

    protected function createState() : State
    {
        $name = $this->faker->unique()->state;
        $acronym =$this->faker->unique()->stateAbbr;

        $transacao = new AddStateTransaction($name, $acronym);
        $transacao->execute();

        return State::where('name', $name)->first();
    }

    protected function createCity() : City
    {
        $name = $this->faker->unique()->city;
        $cep = rand(10000000, 99999999);
        $state = $this->createState();

        $transacao = new AddCityTransaction($name, $cep, $state->id);
        $transacao->execute();
        
        return City::where('name', $name)->where('cep', $cep)->first();
    }

    // protected function createUser(Empresa $empresa) : Usuario
    // {
    //     $nome = $this->faker->unique()->name;
    //     $login = $this->faker->unique()->userName;
    //     $senha = $this->faker->unique()->password;
    //     $cpf = $this->faker->unique()->randomNumber(8);

    //     $transacao = new AddUsuarioTransaction($nome, $login, $senha, $empresa->id, $cpf);
    //     $transacao->execute();

    //     return Usuario::where('nome', $nome)->where('login', $login)->first();
    // }

    // protected function createCustomer(Empresa $empresa, Endereco $enderecoCliente) : Cliente
    // {
    //     $nome = $this->faker->unique()->name; 
    //     $telefone = $this->faker->unique()->phoneNumber; 
    //     $telefone2 = $this->faker->unique()->phoneNumber; 
    //     $dataNascimento = $this->faker->unique()->date($format = 'Y-m-d', $max = 'now'); 
    //     $cpf = $this->faker->unique()->randomNumber(8); 
    //     $identidade = $this->faker->unique()->randomNumber(8);

    //     $transacao = new AddClienteTransaction($nome, $empresa->id, $telefone, $telefone2, $dataNascimento, $cpf, $identidade, $enderecoCliente->id);
    //     $transacao->execute();

    //     return Cliente::where('nome', $nome)->where('cpf', $cpf)->where('identidade', $identidade)->first();
    // }

 
}