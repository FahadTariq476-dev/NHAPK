<?php

namespace App\Models;

use App\Models\User;
use App\Models\Election;
use App\Models\ElectionsCategroy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vote extends Model
{
    use HasFactory;
    protected $table = 'nhapk_votes';

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function candidate()
    {
        return $this->belongsTo(Candidate::class, 'candidateId');
    }

    public function electionCategory()
    {
        return $this->belongsTo(ElectionsCategroy::class, 'electionCategoryId');
    }

    public function election()
    {
        return $this->belongsTo(Election::class, 'electionId');
    }
}
