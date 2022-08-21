<?php

namespace App\Models;

use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusChair extends Model
{
    use HasFactory, GeneratesUuid;

    public function bus()
    {
        return $this->hasOne(Bus::class, 'id', 'bus_id');
    }
}
