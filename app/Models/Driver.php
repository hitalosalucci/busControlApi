<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Driver extends Model
{
    use HasFactory;

    public function validatePassword(string $pass) : bool
    {
        return Hash::check($pass, $this->password);
    }
}
