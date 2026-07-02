<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enquiry;
use Illuminate\Http\Request;

class EnquiryController extends Controller
{
    public function create(Request $request)
    {
        $courses = Course::where('is_active', true)->orderBy('title')->get();
        $selectedCourse = $request->filled('course') ? Course::where('slug', $request->course)->first() : null;

        return view('frontend.enquiry', compact('courses', 'selectedCourse'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'course_id' => ['nullable', 'exists:courses,id'],
            'name'      => ['required', 'string', 'max:160'],
            'email'     => ['nullable', 'email', 'max:160'],
            'phone'     => ['nullable', 'string', 'max:40'],
            'message'   => ['nullable', 'string', 'max:2000'],
        ]);

        Enquiry::create($data);

        return back()->with('message', 'Enquiry sent successfully. R Tech Computer will contact you soon.');
    }
}
