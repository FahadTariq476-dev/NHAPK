<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Election extends Model
{
    use HasFactory;
    protected $table = 'nhapk_elections';

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
    
    public function areas()
    {
        return $this->belongsTo(Area::class, 'areaId');
    }
    
    public function electionCategory()
    {
        return $this->belongsTo(ElectionsCategroy::class, 'electionCategoryId');
    }
    
    public function electionSeat()
    {
        return $this->belongsTo(ElectionSeat::class, 'electionSeatId');
    }


}
