<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    protected $table = 'nhapk_areas';

    public function country()
    {
        return $this->belongsTo(Country::class, 'countryId');
    }
    
    public function state()
    {
        return $this->belongsTo(State::class, 'stateId');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'cityId');
    }
}
