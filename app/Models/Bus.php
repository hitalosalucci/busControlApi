<?php

namespace App\Models;

use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    use HasFactory, GeneratesUuid;


    public function busChairs()
    {
        return $this->hasMany(BusChair::class, 'id', 'bus_id');
    }

    public function findPerUuid($uuid)
    {
        return $this->where('uuid', $uuid)->first();
    }
}
