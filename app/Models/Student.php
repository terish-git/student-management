<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
	/**
     * Get the reporting teacher
     */
    public function teacher()
    {
        return $this->belongsTo('App\Models\Teacher');
    }

    /**
     * Get the mark
     */
    public function mark()
    {
        return $this->belongsTo('App\Models\Mark');
    }
}
