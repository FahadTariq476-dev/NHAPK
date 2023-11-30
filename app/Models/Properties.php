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
}
