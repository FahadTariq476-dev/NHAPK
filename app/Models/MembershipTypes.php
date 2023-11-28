<?php

namespace App\Models;

use App\Models\Membership;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MembershipTypes extends Model
{
    use HasFactory;
    protected $table = 'membership_types';      // Set the table name here

    // Set the relationship of Membership_Types with Membership
    public function memberships(){
        return $this->hasMany(Membership::class, 'membershiptype_id');
    }
    
}
