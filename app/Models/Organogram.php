<?php

namespace App\Models;

use App\Models\User;
use App\Models\OrganogramDesignation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Organogram extends Model
{
    use HasFactory;
    protected $table = 'nhapk_organograms';

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function organogramDesignation()
    {
        return $this->belongsTo(OrganogramDesignation::class, 'organogramDesignationId');
    }
}
