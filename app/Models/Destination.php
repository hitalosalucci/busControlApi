<?php

namespace App\Models;

use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory, GeneratesUuid;

    public function uuidColum()
    {
        return 'uuid';
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }
}
