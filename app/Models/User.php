<?php

namespace App\Models;

use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, GeneratesUuid;

    protected $fillable = [
        'name',
        'email',
        'login',
        'password',
    ];

    protected $hidden = [
        'password'
    ];

    public function validatePassword(string $pass) : bool
    {
        return Hash::check($pass, $this->password);
    }
}
