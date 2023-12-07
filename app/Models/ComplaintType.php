<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplaintType extends Model
{
    use HasFactory;
    protected $table = 'nhapk_complaint_types';

    // Begin: Function to define the relationship pf complaint_types with complaint one complaint types can have many complaints
    public function complaints(){
        return $this->hasMany(Complaint::class,'complaint_type');
    }
    // End: Function to define the relationship pf complaint_types with complaint one complaint types can have many complaints
}
