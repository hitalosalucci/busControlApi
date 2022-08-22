<?php

namespace Tests;

use App\Exceptions\TransactionException;
use App\Models\Bus;
use App\Models\BusChair;
use App\Models\City;
use App\Models\Customer;
use App\Models\Destination;
use App\Models\Driver;
use App\Models\Origin;
use App\Models\State;
use App\Models\Travel;
use App\Models\User;
use App\Transactions\Bus\AddBusTransaction;
use App\Transactions\BusChair\AddBusChairTransaction;
use App\Transactions\City\AddCityTransaction;
use App\Transactions\Customer\AddCustomerTransaction;
use App\Transactions\Destination\AddDestinationTransaction;
use App\Transactions\Driver\AddDriverTransaction;
use App\Transactions\Origin\AddOriginTransaction;
use App\Transactions\State\AddStateTransaction;
use App\Transactions\Travel\AddTravelTransaction;
use App\Transactions\User\AddUserTransaction;
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

    protected function createOrigin() : Origin
    {
    
        $city = $this->createCity();
    
        $transaction = new AddOriginTransaction($city->id);
        $transaction->execute();

        return Origin::where('city_id', $city->id)->first();
    }

    protected function createDestination() : Destination
    {
    
        $city = $this->createCity();
    
        $transaction = new AddDestinationTransaction($city->id);
        $transaction->execute();

        return Destination::where('city_id', $city->id)->first();
    }

    protected function createBus() : Bus
    {
        $manufacturer = $this->faker->unique()->company;
        $model = $this->faker->unique()->word;
        $code = rand(1000, 999999999);
        $description = $this->faker->text(350);
        $color = $this->faker->colorName;

        $transaction = new AddBusTransaction($manufacturer, $model, $code, $description, $color);
        $transaction->execute();
        
        return Bus::where('code', $code)->where('manufacturer', $manufacturer)->first();
    }

    protected function createDriver() : Driver
    {

        $name = $this->faker->unique()->name;
        $email = $this->faker->unique()->companyEmail;
        $password = $this->faker->password;
        $cnh = rand(10000000000, 99999999999);
        $cpf = rand(10000000000, 99999999999);
        $rg = rand(10000000, 99999999);

        $transaction = new AddDriverTransaction($name, $email, $password, $cnh, $cpf, $rg);
        $transaction->execute();
        
        return Driver::where('name', $name)->where('email', $email)->first();
    }

    protected function createTravel() : Travel
    {
        $name = $this->faker->unique()->company;
        $date = $this->faker->unique()->date($format = 'Y-m-d H:i:m'); 
        $bus = $this->createBus();
        $origin = $this->createOrigin();
        $destination = $this->createDestination();
        $driver = $this->createDriver();

        $transaction = new AddTravelTransaction($name, $date, $origin->id, $destination->id, $bus->id, $driver->id);
        $transaction->execute();

        return Travel::where('name', $name)->where('date', $date)->where('origin_id', $origin->id)->first();
    }

    public function createCustomer() : Customer
    {
        $name = $this->faker->unique()->name;
        $email = $this->faker->unique()->email;
        $password = $this->faker->password;
        $phone = $this->faker->e164PhoneNumber;
        
        $city = $this->createCity();

        $transaction = new AddCustomerTransaction($name, $email, $password, $phone, $city->id);
        $transaction->execute();

        return Customer::where('name', $name)->where('email', $email)->first();
    }

    public function createUser() : User
    {
        $name = $this->faker->unique()->name;
        $login = $this->faker->unique()->companyEmail;
        $email = $this->faker->unique()->freeEmail;
        $password = $this->faker->password;
        $level = 'admin';

        $transaction = new AddUserTransaction($name, $login, $email, $password, $level);
        $transaction->execute();

        return User::where('name', $name)->where('email', $email)->first();
    }

    public function createBusChair() : BusChair
    {
        $bus = $this->createBus();

        $number = rand(1, 50);
        $code = $this->faker->postcode;

        $transaction = new AddBusChairTransaction($number, $code, $bus->id);
        $transaction->execute();

        return BusChair::where('number', $number)->where('code', $code)->first();
    }

 
}