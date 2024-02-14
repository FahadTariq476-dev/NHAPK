<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Begin: Function to define the relationship of user with properties. User has one properties
    public function properties()
    {
        return $this->hasOne(Properties::class, 'author_id');
    }
    // End: Function to define the relationship of user with properties. User has one properties

    // Begin: Function to define the relationship of partner-user with properties
    public function partnerProperties()
    {
        return $this->belongsToMany(Properties::class, 'properties_partner', 'author_id', 'properties_id');
    }
    // End: Function to define the relationship of partner-user with properties
    
    // Begin: Function to define the relationship of warden-user with properties
    public function wardenProperties()
    {
        return $this->belongsToMany(Properties::class, 'properties_warden', 'author_id', 'properties_id');
    }
    // End: Function to define the relationship of warden-user with properties

    public function country()
    {
        // Define the relationship to the Country model
        return $this->belongsTo(Country::class, 'countryId');
    }

    public function state()
    {
        // Define the relationship to the State model
        return $this->belongsTo(State::class, 'stateId');
    }
    
    public function city()
    {
        // Define the relationship to the City model
        return $this->belongsTo(City::class, 'cityId');
    }

    public function area(){
        return $this->belongsTo(Area::class, 'areaId');
    }
}
