<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseLesson extends Model
{
    protected $fillable = [
        'course_module_id',
        'title',
        'video_url',
        'notes_url',
        'practice_file_url',
        'description',
        'is_preview',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_preview' => 'boolean',
        'is_active'  => 'boolean',
    ];

    public function module()
    {
        return $this->belongsTo(CourseModule::class, 'course_module_id');
    }
}
