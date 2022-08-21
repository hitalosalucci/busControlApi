<?php

namespace Tests;

use App\Exceptions\TransactionException;
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

    protected function assertErroTransaction(TransactionException $excecao, string $campo, string $erroEsperado)
    {
        $erros = $excecao->getErrors();
        $this->assertTrue(isset($erros[$campo]), 'Faltando campo "'.$campo.'" em exceção');
        $this->assertEquals($erroEsperado, $erros[$campo], 'Erro do campo "'.$campo.'" incorreto');
    }

    // protected function createState() : Estado
    // {
    //     $nome = $this->faker->unique()->state;
    //     $sigla =$this->faker->unique()->stateAbbr;

    //     $transacao = new AddEstadoTransaction($nome, $sigla);
    //     $transacao->execute();

    //     return Estado::where('nome', $nome)->first();
    // }

    // protected function createCity(Estado $estado) : Cidade
    // {
    //     $nome = $this->faker->unique()->city;

    //     $transacao = new AddCidadeTransaction($nome, $estado->id);
    //     $transacao->execute();
        
    //     return Cidade::where('nome', $nome)->first();
    // }

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