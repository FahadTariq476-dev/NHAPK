<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    use HasFactory;
    protected $table = 'member_ships';  // Set the table name here

    // Set the relationship of Membership with Membership_Types
    public function membershipTypes(){
        return $this->belongsTo(MembershipTypes::class,'membershiptype_id');
    }

    // Set the relationship of membership having name 'country' with countries table
    public function country(){
        return $this->belongsTo(Country::class, 'country_id');
    }

    // Set the relationship of membership having name 'state' with states table
    public function state(){
        return $this->belongsTo(State::class, 'states_id');
    }
    
    // Set the relationship of membership having name 'city' with cities table
    public function city(){
        return $this->belongsTo(City::class, 'city_id');
    }
    
    // Set the relationship of memebership having name 'property' with properties table
    public function property(){
        return $this->belongsTo(Properties::class,'hostelreg_no');
    }
}
