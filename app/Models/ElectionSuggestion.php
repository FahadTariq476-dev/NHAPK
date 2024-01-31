<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectionSuggestion extends Model
{
    use HasFactory;
    protected $table = 'nhapk_election_suggestions';

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }
    
    public function candidate()
    {
        return $this->belongsTo(Candidate::class, 'candidateId');
    }
}
