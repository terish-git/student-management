<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
    /**
     * Get the mark
     */
    public function student()
    {
        return $this->belongsTo('App\Models\Student', 'id', 'teacher_id');
    }
}
