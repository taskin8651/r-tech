@extends('layouts.admin')

@section('page-title', 'Course Detail')

@section('content')
<div class="admin-page-head">
    <div>
        <h2 class="admin-page-title">{{ $course->title }}</h2>
        <p class="admin-page-subtitle">{{ $course->category->name ?? 'Uncategorized' }} / Rs. {{ number_format($course->display_price, 0) }}</p>
    </div>
    <a class="btn-primary" href="{{ route('courses.show', $course) }}" target="_blank"><i class="fas fa-up-right-from-square"></i> Frontend</a>
</div>

<div class="stats-grid">
    <div class="stat-card"><p class="stat-label">Enrollments</p><p class="stat-value">{{ $course->enrollments->count() }}</p></div>
    <div class="stat-card"><p class="stat-label">Modules</p><p class="stat-value">{{ $course->modules->count() }}</p></div>
    <div class="stat-card"><p class="stat-label">Lessons</p><p class="stat-value">{{ $course->modules->sum(fn($module) => $module->lessons->count()) }}</p></div>
    <div class="stat-card"><p class="stat-label">Certificate</p><p class="stat-value">{{ $course->has_certificate ? 'Yes' : 'No' }}</p></div>
</div>

<div class="page-card" style="padding:24px">
    <h3 class="page-card-title">Description</h3>
    <p style="color:#475569;line-height:1.7">{{ $course->description }}</p>
    <h3 class="page-card-title" style="margin-top:24px">Syllabus</h3>
    @foreach($course->modules as $module)
        <div style="border-top:1px solid #e5e7eb;padding:16px 0">
            <strong>{{ $module->title }}</strong>
            <p style="color:#64748b">{{ $module->description }}</p>
            @foreach($module->lessons as $lesson)
                <p style="margin:6px 0;color:#475569">- {{ $lesson->title }}</p>
            @endforeach
        </div>
    @endforeach
</div>
@endsection
