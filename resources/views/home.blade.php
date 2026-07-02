@extends('layouts.admin')

@section('page-title', 'Dashboard')

@section('content')
<style>
    .dash-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:18px}.dash-card{background:#fff;border:1px solid #e5e7eb;border-radius:14px;padding:20px}.dash-label{font-size:12px;color:#64748b;text-transform:uppercase;font-weight:800;letter-spacing:.04em}.dash-value{font-size:30px;font-weight:800;color:#0f172a;margin-top:6px}.dash-panel{background:#fff;border:1px solid #e5e7eb;border-radius:14px;padding:20px}.dash-table{width:100%;border-collapse:collapse}.dash-table th{font-size:12px;text-align:left;color:#64748b;text-transform:uppercase;padding:10px;border-bottom:1px solid #e5e7eb}.dash-table td{padding:12px 10px;border-bottom:1px solid #f1f5f9;color:#334155}.pill{display:inline-flex;padding:4px 9px;border-radius:999px;background:#eef2ff;color:#4f46e5;font-size:12px;font-weight:700}.quick{display:grid;grid-template-columns:repeat(4,1fr);gap:12px;margin-top:18px}.quick a{display:flex;align-items:center;gap:10px;border-radius:12px;padding:14px;background:#f8fafc;color:#0f172a;font-weight:700;text-decoration:none}@media(max-width:900px){.dash-grid,.quick{grid-template-columns:repeat(2,1fr)}.two-col{grid-template-columns:1fr!important}}@media(max-width:560px){.dash-grid,.quick{grid-template-columns:1fr}}
</style>

<div class="admin-page-head">
    <div>
        <h2 class="admin-page-title">R Tech Dashboard</h2>
        <p class="admin-page-subtitle">Real course, enrollment, enquiry and certificate overview.</p>
    </div>
</div>

<div class="dash-grid">
    <div class="dash-card"><div class="dash-label">Students</div><div class="dash-value">{{ $stats['students'] }}</div></div>
    <div class="dash-card"><div class="dash-label">Courses</div><div class="dash-value">{{ $stats['courses'] }}</div></div>
    <div class="dash-card"><div class="dash-label">Enrollments</div><div class="dash-value">{{ $stats['enrollments'] }}</div></div>
    <div class="dash-card"><div class="dash-label">Revenue</div><div class="dash-value">Rs. {{ number_format($stats['revenue'], 0) }}</div></div>
    <div class="dash-card"><div class="dash-label">Certificates Uploaded</div><div class="dash-value">{{ $stats['certificates'] }}</div></div>
    <div class="dash-card"><div class="dash-label">Enquiries</div><div class="dash-value">{{ $stats['enquiries'] }}</div></div>
    <div class="dash-card"><div class="dash-label">Pending Certificates</div><div class="dash-value">{{ max($stats['enrollments'] - $stats['certificates'], 0) }}</div></div>
    <div class="dash-card"><div class="dash-label">Avg Revenue</div><div class="dash-value">Rs. {{ $stats['enrollments'] ? number_format($stats['revenue'] / $stats['enrollments'], 0) : 0 }}</div></div>
</div>

<div class="two-col" style="display:grid;grid-template-columns:1.2fr .8fr;gap:18px">
    <div class="dash-panel">
        <h3 class="page-card-title">Recent Enrollments</h3>
        <table class="dash-table">
            <thead><tr><th>Student</th><th>Course</th><th>Payment</th><th>Progress</th></tr></thead>
            <tbody>
            @forelse($recentEnrollments as $enrollment)
                <tr>
                    <td>{{ $enrollment->user->name }}</td>
                    <td>{{ $enrollment->course->title }}</td>
                    <td><span class="pill">{{ ucfirst(str_replace('_', ' ', $enrollment->payment_status)) }}</span></td>
                    <td>{{ $enrollment->progress }}%</td>
                </tr>
            @empty
                <tr><td colspan="4">No enrollments yet.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="dash-panel">
        <h3 class="page-card-title">Top Courses</h3>
        @forelse($topCourses as $course)
            <div style="display:flex;justify-content:space-between;gap:12px;padding:12px 0;border-bottom:1px solid #f1f5f9">
                <div><strong>{{ $course->title }}</strong><div style="font-size:12px;color:#64748b">{{ $course->category->name ?? 'Course' }}</div></div>
                <span class="pill">{{ $course->enrollments_count }} enroll</span>
            </div>
        @empty
            <p style="color:#64748b">No courses yet.</p>
        @endforelse
    </div>
</div>

<div class="dash-panel" style="margin-top:18px">
    <h3 class="page-card-title">Recent Enquiries</h3>
    <table class="dash-table">
        <thead><tr><th>Name</th><th>Contact</th><th>Course</th><th>Status</th></tr></thead>
        <tbody>
        @forelse($recentEnquiries as $enquiry)
            <tr>
                <td>{{ $enquiry->name }}</td>
                <td>{{ $enquiry->phone ?: $enquiry->email }}</td>
                <td>{{ $enquiry->course->title ?? '-' }}</td>
                <td><span class="pill">{{ ucfirst($enquiry->status) }}</span></td>
            </tr>
        @empty
            <tr><td colspan="4">No enquiries yet.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>

<div class="quick">
    <a href="{{ route('admin.courses.create') }}"><i class="fas fa-plus"></i> Add Course</a>
    <a href="{{ route('admin.enrollments.create') }}"><i class="fas fa-user-graduate"></i> Enroll Student</a>
    <a href="{{ route('admin.enquiries.index') }}"><i class="fas fa-message"></i> View Enquiries</a>
    <a href="{{ route('courses.index') }}" target="_blank"><i class="fas fa-globe"></i> Frontend</a>
</div>
@endsection
