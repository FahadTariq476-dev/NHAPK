<?php

namespace App\Models;

use App\Models\City;
use App\Models\State;
use App\Models\Election;
use App\Models\ElectionsCategroy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Candidate extends Model
{
    use HasFactory;
    protected $table = 'nhapk_candidates';

    public function state()
    {
        return $this->belongsTo(State::class, 'stateId');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'cityId');
    }

    public function electionCategory()
    {
        return $this->belongsTo(ElectionsCategroy::class, 'electionCategoryId');
    }

    public function election()
    {
        return $this->belongsTo(Election::class, 'electionId');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }
}
