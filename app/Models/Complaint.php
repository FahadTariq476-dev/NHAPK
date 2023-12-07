<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;
    protected $table = 'nhapk_complaints';

    public function property(){
        return $this->belongsTo(Properties::class, 'hostel_id');
    }

    // Begin: Function to define the relationship of complaint with complaint_types one complaints have one complaint_types
    public function complaintType(){
        return $this->belongsTo(ComplaintType::class,'complaint_type');
    }
    // End: Function to define the relationship of complaint with complaint_types one complaints have one complaint types
}
