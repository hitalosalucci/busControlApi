<?php

namespace App\Models;

use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{
    use HasFactory, GeneratesUuid;

    protected $table = 'travels';
    protected $primaryKey = 'id';

    public function bus()
    {
        return $this->belongsTo(Bus::class, 'bus_id', 'id');
    }

    public function origin()
    {
        return $this->belongsTo(Origin::class, 'origin_id', 'id');
    }

    public function destination()
    {
        return $this->belongsTo(Destination::class, 'destination_id', 'id');
    }
}
