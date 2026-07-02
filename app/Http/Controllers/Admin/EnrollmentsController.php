<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\Course;
use App\Models\CourseEnrollment;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class EnrollmentsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('course_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $enrollments = CourseEnrollment::with(['user', 'course', 'certificate'])
            ->when(request('certificate') === 'uploaded', fn ($query) => $query->whereHas('certificate'))
            ->when(request('certificate') === 'pending', fn ($query) => $query->whereDoesntHave('certificate'))
            ->when(request('payment_status'), fn ($query, $status) => $query->where('payment_status', $status))
            ->latest()
            ->get();

        return view('admin.enrollments.index', compact('enrollments'));
    }

    public function create()
    {
        abort_if(Gate::denies('course_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $students = User::orderBy('name')->pluck('name', 'id');
        $courses = Course::where('is_active', true)->orderBy('title')->pluck('title', 'id');

        return view('admin.enrollments.create', compact('students', 'courses'));
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('course_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $data = $request->validate([
            'user_id'        => ['required', 'exists:users,id'],
            'course_id'      => ['required', 'exists:courses,id'],
            'amount_paid'    => ['nullable', 'numeric', 'min:0'],
            'payment_status' => ['required', 'string', 'max:50'],
            'transaction_id' => ['nullable', 'string', 'max:120'],
        ]);

        $data['status'] = 'active';
        $data['progress'] = 0;

        CourseEnrollment::updateOrCreate(
            ['user_id' => $data['user_id'], 'course_id' => $data['course_id']],
            $data
        );

        return redirect()->route('admin.enrollments.index')->with('message', 'Student enrolled successfully.');
    }

    public function edit(CourseEnrollment $enrollment)
    {
        abort_if(Gate::denies('course_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $enrollment->load(['user', 'course', 'certificate']);

        return view('admin.enrollments.edit', compact('enrollment'));
    }

    public function update(Request $request, CourseEnrollment $enrollment)
    {
        abort_if(Gate::denies('course_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $data = $request->validate([
            'status'           => ['required', 'string', 'max:50'],
            'payment_status'   => ['required', 'string', 'max:50'],
            'transaction_id'   => ['nullable', 'string', 'max:120'],
            'amount_paid'      => ['nullable', 'numeric', 'min:0'],
            'progress'         => ['required', 'integer', 'min:0', 'max:100'],
            'certificate_id'   => ['nullable', 'string', 'max:120'],
            'certificate_file' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:10240'],
        ]);

        $enrollment->update([
            'status'         => $data['status'],
            'payment_status' => $data['payment_status'],
            'transaction_id' => $data['transaction_id'] ?? null,
            'amount_paid'    => $data['amount_paid'] ?? 0,
            'progress'       => $data['progress'],
            'completed_at'   => (int) $data['progress'] === 100 ? ($enrollment->completed_at ?: now()) : null,
        ]);

        if ($request->hasFile('certificate_file')) {
            $certificate = Certificate::firstOrCreate(
                ['course_enrollment_id' => $enrollment->id],
                [
                    'user_id'        => $enrollment->user_id,
                    'course_id'      => $enrollment->course_id,
                    'certificate_id' => $data['certificate_id'] ?: 'RTC-' . now()->format('Y') . '-' . strtoupper(Str::random(8)),
                    'issued_at'      => now(),
                    'is_revoked'     => false,
                ]
            );

            $certificate->update([
                'certificate_id' => $data['certificate_id'] ?: $certificate->certificate_id,
                'issued_at'      => $certificate->issued_at ?: now(),
                'is_revoked'     => false,
            ]);

            $certificate->addMediaFromRequest('certificate_file')->toMediaCollection('certificate_file');
        }

        return redirect()->route('admin.enrollments.index')->with('message', 'Enrollment updated successfully.');
    }

    public function destroy(CourseEnrollment $enrollment)
    {
        abort_if(Gate::denies('course_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $enrollment->delete();

        return back()->with('message', 'Enrollment removed successfully.');
    }
}
