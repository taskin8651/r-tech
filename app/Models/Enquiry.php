<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    protected $fillable = ['course_id', 'name', 'email', 'phone', 'message', 'status'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
