<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class SiteSetting extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'site_name',
        'logo',
        'phone',
        'whatsapp',
        'email',
        'address',
        'timing',
        'facebook_url',
        'instagram_url',
        'youtube_url',
        'linkedin_url',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'about_intro',
        'mission',
        'vision',
        'privacy_policy',
        'terms_conditions',
        'refund_policy',
    ];

    public static function current(): self
    {
        return self::firstOrCreate([], [
            'site_name'        => 'R Tech Computer',
            'about_intro'      => 'R Tech Computer helps students build job-ready digital skills through structured courses, hands-on practice, online lessons and uploaded completion certificates.',
            'mission'          => 'Make computer education accessible, practical and career-oriented for every student.',
            'vision'           => 'Help learners become confident with office tools, accounting, design, web and digital workflows.',
            'privacy_policy'   => "We collect basic student and enquiry information for admission, course access, progress tracking, support and certificates.\nWe do not sell student data to third parties.",
            'terms_conditions' => "Course access is provided only to registered or manually enrolled students.\nStudents must not share private course content or login details.",
            'refund_policy'    => "Refund eligibility depends on institute approval and course access status.\nApproved refunds are processed through the original payment or agreed manual method.",
        ]);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('site_logo')->singleFile();
        $this->addMediaCollection('favicon')->singleFile();
    }

    public function getLogoUrlAttribute(): ?string
    {
        return $this->getFirstMediaUrl('site_logo') ?: $this->logo;
    }

    public function getFaviconUrlAttribute(): ?string
    {
        return $this->getFirstMediaUrl('favicon');
    }
}
