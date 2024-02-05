<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DynamicSurveysForms extends Model
{
    use HasFactory;
    protected $table = 'nhapk_dynamic_surveys_forms';
    protected $fillable = [
        'title',
        'form_structure',
        'description',
        'role_id',
    ];

    // Ensure that the 'form_structure' field is cast to an array
    protected $casts = [
        'form_structure' => 'array',
    ];

    public function roleId()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
}
