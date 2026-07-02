<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function home()
    {
        $featuredCourses = Course::with('category')
            ->where('is_active', true)
            ->where('is_featured', true)
            ->latest()
            ->take(6)
            ->get();

        if ($featuredCourses->isEmpty()) {
            $featuredCourses = Course::with('category')->where('is_active', true)->latest()->take(6)->get();
        }

        return view('welcome', compact('featuredCourses'));
    }

    public function courses(Request $request)
    {
        $categories = CourseCategory::where('is_active', true)->orderBy('name')->get();
        $courses = Course::with('category')
            ->where('is_active', true)
            ->when($request->filled('category'), function ($query) use ($request) {
                $query->whereHas('category', fn ($category) => $category->where('slug', $request->category));
            })
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where(function ($inner) use ($request) {
                    $inner->where('title', 'like', '%' . $request->search . '%')
                        ->orWhere('short_description', 'like', '%' . $request->search . '%');
                });
            })
            ->latest()
            ->paginate(9)
            ->withQueryString();

        return view('frontend.courses.index', compact('categories', 'courses'));
    }

    public function course(Course $course)
    {
        abort_if(! $course->is_active, 404);

        $course->load(['category', 'modules.lessons']);

        return view('frontend.courses.show', compact('course'));
    }

    public function about()
    {
        $settings = SiteSetting::current();

        return view('frontend.pages.about', compact('settings'));
    }

    public function contact()
    {
        $courses = Course::where('is_active', true)->orderBy('title')->get();
        $selectedCourse = null;
        $settings = SiteSetting::current();

        return view('frontend.pages.contact', compact('courses', 'selectedCourse', 'settings'));
    }

    public function privacy()
    {
        return view('frontend.pages.policy', [
            'title' => 'Privacy Policy',
            'intro' => 'How R Tech Computer handles student and enquiry information.',
            'body'  => SiteSetting::current()->privacy_policy,
        ]);
    }

    public function terms()
    {
        return view('frontend.pages.policy', [
            'title' => 'Terms & Conditions',
            'intro' => 'Rules for using R Tech Computer online course services.',
            'body'  => SiteSetting::current()->terms_conditions,
        ]);
    }

    public function refund()
    {
        return view('frontend.pages.policy', [
            'title' => 'Refund Policy',
            'intro' => 'Refund rules for digital courses and enrollment requests.',
            'body'  => SiteSetting::current()->refund_policy,
        ]);
    }

    public function verify(Request $request)
    {
        $certificate = null;

        if ($request->filled('certificate_id')) {
            $certificate = Certificate::with(['user', 'course'])
                ->where('certificate_id', $request->certificate_id)
                ->first();
        }

        return view('frontend.verify', compact('certificate'));
    }
}
