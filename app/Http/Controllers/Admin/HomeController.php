<?php

namespace App\Http\Controllers\Admin;

use App\Models\Certificate;
use App\Models\Course;
use App\Models\CourseEnrollment;
use App\Models\Enquiry;
use App\Models\User;

class HomeController
{
    public function index()
    {
        $stats = [
            'students'     => User::whereHas('roles', fn ($query) => $query->where('title', 'User'))->count(),
            'courses'      => Course::count(),
            'enrollments'  => CourseEnrollment::count(),
            'revenue'      => CourseEnrollment::sum('amount_paid'),
            'certificates' => Certificate::count(),
            'enquiries'    => Enquiry::count(),
        ];

        $recentEnrollments = CourseEnrollment::with(['user', 'course'])->latest()->take(6)->get();
        $recentEnquiries = Enquiry::with('course')->latest()->take(6)->get();
        $topCourses = Course::withCount('enrollments')->orderByDesc('enrollments_count')->take(5)->get();

        return view('home', compact('stats', 'recentEnrollments', 'recentEnquiries', 'topCourses'));
    }
}
