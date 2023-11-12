<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    use HasFactory;
    protected $table = 'member_ships';  // Set the table name here
    protected $fillable = [
        'name',
        'cnic',
        'membershiptype_id',
        'hostelreg_no',
        'referal_cnic',
        'transaction_no',
        'gender',
        'since'
    ];
}
