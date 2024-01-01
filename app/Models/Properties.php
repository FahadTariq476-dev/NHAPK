<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Properties extends Model
{
    use HasFactory;
    protected $table = 'properties';

    public function complaints(){
        return $this->hasMany(Complaint::class, 'hostel_id');
    }

    // Begin: Function to define relationship of hostel with user. in this one property can have one user only
    public function users(){
        return $this->belongsTo(User::class,'author_id');
    }
    // End: Function to define relationship of hostel with user. in this one property can have one user only

    // Begin: Function to define relationship of hostel with partners. 
    public function partners()
    {
        return $this->belongsToMany(User::class, 'properties_partner', 'properties_id', 'author_id');
    }
    // End: Function to define relationship of hostel with partners.
    
    // Begin: Function to define relationship of hostel with wardens. 
    public function wardens()
    {
        return $this->belongsToMany(User::class, 'properties_warden', 'properties_id', 'author_id');
    }
    // End: Function to define relationship of hostel with wardens.

    // Begin: Function to define relationship of hostel with states
    public function states(){
        return $this->belongsTo(State::class, 'state_id');
    }
    // End: Function to define relationship of hostel with states
    
    // Begin: Function to define relationship of hostel with cities
    public function cities(){
        return $this->belongsTo(City::class, 'city_id');
    }
    // End: Function to define relationship of hostel with cities
    
    // Begin: Function define relationship of hostel with proerties_address
    // Define a one-to-one relationship with PropertiesAddress
    public function address()
    {
        return $this->hasOne(PropertiesAddress::class, 'property_id');
    }
    // End: Function define relationship of hostel with proerties_address
    
    // Begin: Function define relationship of hostel with proerties_metas
    // Define a one-to-one relationship with Properties_metas
    public function metas()
    {
        return $this->hasOne(PropertiesMetas::class, 'property_id');
    }
    // End: Function define relationship of hostel with proerties_metas

    // Begin: Function to defina relationship with luxury
    // Define Many to Many relationship withy luxury where as piviot table is property_luxuries
    public function luxuries(){
        return $this->belongsToMany(Luxury::class, 'property_luxuries', 'property_id','luxury_id');
    }
    // End: Function to defina relationship with luxury
    
    // Begin: Function to defina relationship with amenities
    // Define Many to Many relationship withy amenities where as piviot table is property_amenities
    public function amenities(){
        return $this->belongsToMany(Amenity::class, 'property_amenities', 'property_id','amenity_id');
    }
    // End: Function to defina relationship with amenities
    
    // Begin: Function to defina relationship with facilities
    // Define Many to Many relationship withy facilities where as piviot table is property_facilities
    public function facilities(){
        return $this->belongsToMany(Facility::class, 'property_facilities', 'property_id','facility_id');
    }
    // End: Function to defina relationship with facilities
    
    // Begin: Function to defina relationship with features
    // Define Many to Many relationship withy features where as piviot table is property_facilities
    public function features(){
        return $this->belongsToMany(Feature::class, 'property_features', 'property_id','feature_id');
    }
    // End: Function to defina relationship with features

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'property_tags', 'property_id', 'tag_id');
    }
}
