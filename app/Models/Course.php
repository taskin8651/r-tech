<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Course extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia;

    protected $fillable = [
        'course_category_id',
        'title',
        'slug',
        'short_description',
        'description',
        'image',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'price',
        'discount_price',
        'duration',
        'level',
        'has_certificate',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'has_certificate' => 'boolean',
        'is_featured'    => 'boolean',
        'is_active'      => 'boolean',
        'price'          => 'decimal:2',
        'discount_price' => 'decimal:2',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('course_image')->singleFile();
    }

    public function getImageUrlAttribute(): string
    {
        return $this->getFirstMediaUrl('course_image') ?: ($this->image ?: $this->fallbackImage());
    }

    private function fallbackImage(): string
    {
        $seed = urlencode($this->title ?: 'R Tech Computer');

        return "https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=1200&q=80&seed={$seed}";
    }

    public function category()
    {
        return $this->belongsTo(CourseCategory::class, 'course_category_id');
    }

    public function modules()
    {
        return $this->hasMany(CourseModule::class)->orderBy('sort_order');
    }

    public function lessons()
    {
        return $this->hasManyThrough(CourseLesson::class, CourseModule::class);
    }

    public function enrollments()
    {
        return $this->hasMany(CourseEnrollment::class);
    }

    public function getDisplayPriceAttribute()
    {
        return $this->discount_price ?: $this->price;
    }
}
