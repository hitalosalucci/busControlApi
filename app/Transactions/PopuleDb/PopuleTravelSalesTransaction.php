<?php

namespace App\Transactions\PopuleDb;

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
use Faker\Factory as Faker;
use App\Transactions\Transaction;
use App\Transactions\Travel\AddTravelTransaction;
use App\Transactions\TravelSale\AddTravelSaleTransaction;
use App\Transactions\User\AddUserTransaction;

class PopuleTravelSalesTransaction implements Transaction
{

    public function execute()
    {
        $price = rand(1, 10000);

        $busChair = $this->createBusChair();
        $bus = $busChair->bus;
        $travel = $this->createTravel();
        $customer = $this->createCustomer();
        $user = $this->createUser();

        $transaction = new AddTravelSaleTransaction($price, $travel->id, $busChair->id, $bus->id, $customer->id, $user->id);
        $transaction->execute();
    }

    protected function createState() : State
    {
        $name = Faker::create()->unique()->state;
        $acronym =Faker::create()->unique()->stateAbbr;

        $transacao = new AddStateTransaction($name, $acronym);
        $transacao->execute();

        return State::where('name', $name)->first();
    }

    protected function createCity() : City
    {
        $name = Faker::create()->unique()->city;
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
        $manufacturer = Faker::create()->unique()->company;
        $model = Faker::create()->unique()->word;
        $code = rand(1000, 999999999);
        $description = Faker::create()->text(350);
        $color = Faker::create()->colorName;

        $transaction = new AddBusTransaction($manufacturer, $model, $code, $description, $color);
        $transaction->execute();
        
        return Bus::where('code', $code)->where('manufacturer', $manufacturer)->first();
    }

    protected function createDriver() : Driver
    {

        $name = Faker::create()->unique()->name;
        $email = Faker::create()->unique()->companyEmail;
        $password = Faker::create()->password;
        $cnh = rand(10000000000, 99999999999);
        $cpf = rand(10000000000, 99999999999);
        $rg = rand(10000000, 99999999);

        $transaction = new AddDriverTransaction($name, $email, $password, $cnh, $cpf, $rg);
        $transaction->execute();
        
        return Driver::where('name', $name)->where('email', $email)->first();
    }

    protected function createTravel() : Travel
    {
        $name = Faker::create()->unique()->company;
        $date = Faker::create()->unique()->date($format = 'Y-m-d H:i:m'); 
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
        $name = Faker::create()->unique()->name;
        $email = Faker::create()->unique()->email;
        $password = Faker::create()->password;
        $phone = Faker::create()->e164PhoneNumber;
        
        $city = $this->createCity();

        $transaction = new AddCustomerTransaction($name, $email, $password, $phone, $city->id);
        $transaction->execute();

        return Customer::where('name', $name)->where('email', $email)->first();
    }

    public function createUser() : User
    {
        $name = Faker::create()->unique()->name;
        $login = Faker::create()->unique()->companyEmail;
        $email = Faker::create()->unique()->freeEmail;
        $password = Faker::create()->password;
        $level = 'admin';

        $transaction = new AddUserTransaction($name, $login, $email, $password, $level);
        $transaction->execute();

        return User::where('name', $name)->where('email', $email)->first();
    }

    public function createBusChair() : BusChair
    {
        $bus = $this->createBus();

        $number = rand(1, 50);
        $code = Faker::create()->postcode;

        $transaction = new AddBusChairTransaction($number, $code, $bus->id);
        $transaction->execute();

        return BusChair::where('number', $number)->where('code', $code)->first();
    }


}
