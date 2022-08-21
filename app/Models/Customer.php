<?php

namespace App\Models;

use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Customer extends Model
{
    use HasFactory;
    use GeneratesUuid;

    public function uuidColum()
    {
        return 'uuid';
    }

    public function validatePassword(string $pass) : bool
    {
        return Hash::check($pass, $this->password);
    }

    public function city()
    {
        return $this->hasOne(City::class, 'id', 'city_id');
    }
}
