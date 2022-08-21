<?php

namespace App\Models;

use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Driver extends Model
{
    use HasFactory, GeneratesUuid;

    public function validatePassword(string $pass) : bool
    {
        return Hash::check($pass, $this->password);
    }
}
