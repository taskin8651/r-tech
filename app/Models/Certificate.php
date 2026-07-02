<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Certificate extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'user_id',
        'course_id',
        'course_enrollment_id',
        'certificate_id',
        'issued_at',
        'is_revoked',
    ];

    protected $casts = [
        'issued_at'  => 'datetime',
        'is_revoked' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function enrollment()
    {
        return $this->belongsTo(CourseEnrollment::class, 'course_enrollment_id');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('certificate_file')->singleFile();
    }

    public function getFileUrlAttribute(): string
    {
        return $this->getFirstMediaUrl('certificate_file');
    }
}
