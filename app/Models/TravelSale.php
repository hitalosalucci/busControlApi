<?php

namespace App\Models;

use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelSale extends Model
{
    use HasFactory, GeneratesUuid;

    public function bus()
    {
        return $this->belongsTo(Bus::class, 'bus_id', 'id');
    }

    public function busChair()
    {
        return $this->belongsTo(BusChair::class, 'bus_chair_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function travel()
    {
        return $this->belongsTo(Travel::class, 'travel_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function checkBusChairUsed($busChairIdCheck)
    {
        $busChair = $this->where('bus_chair_id', $busChairIdCheck)->first();

        if (is_null($busChair))
            return false;
         
        return true;
    }
}
