<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseEnrollment;

class StudentController extends Controller
{
    public function dashboard()
    {
        $enrollments = auth()->user()->enrollments()
            ->with(['course.category', 'certificate'])
            ->latest()
            ->get();

        return view('student.dashboard', compact('enrollments'));
    }

    public function enroll(Course $course)
    {
        abort_if(! $course->is_active, 404);

        $enrollment = CourseEnrollment::firstOrCreate(
            ['user_id' => auth()->id(), 'course_id' => $course->id],
            [
                'status'         => 'active',
                'amount_paid'    => $course->display_price,
                'payment_status' => $course->display_price > 0 ? 'pending_gateway' : 'free',
                'progress'       => 0,
            ]
        );

        return redirect()
            ->route('student.learn', $enrollment)
            ->with('message', 'Course access unlocked for your student dashboard.');
    }

    public function learn(CourseEnrollment $enrollment)
    {
        abort_if($enrollment->user_id !== auth()->id(), 403);

        $enrollment->load(['course.modules.lessons', 'certificate']);

        return view('student.learn', compact('enrollment'));
    }

    public function complete(CourseEnrollment $enrollment)
    {
        abort_if($enrollment->user_id !== auth()->id(), 403);

        $enrollment->update([
            'progress'     => 100,
            'completed_at' => $enrollment->completed_at ?: now(),
        ]);

        if (! $enrollment->certificate && $enrollment->course->has_certificate) {
            return back()->with('message', 'Course marked complete. Admin will upload your certificate after verification.');
        }

        return back()->with('message', 'Course marked complete.');
    }

    public function certificate(Certificate $certificate)
    {
        abort_if($certificate->user_id !== auth()->id(), 403);

        $certificate->load(['user', 'course']);

        return view('student.certificate', compact('certificate'));
    }
}
