@extends('layouts.frontend')

@section('title', 'Student Dashboard | R Tech Computer')

@section('content')
<section class="page">
    <div class="wrap">
        @if(session('message'))<div class="alert">{{ session('message') }}</div>@endif
        <div class="hero-small" style="padding-top:20px">
            <div class="eyebrow">Student Panel</div>
            <h1>Welcome, {{ auth()->user()->name }}.</h1>
            <p class="muted">Continue learning, track progress and download certificates from one place.</p>
            <a class="btn" href="{{ route('student.profile.show') }}" style="margin-top:16px">View / Edit Profile</a>
        </div>

        <div class="student-tabs">
            <button class="student-tab active" data-tab="courses">My Courses</button>
            <button class="student-tab" data-tab="certificates">Certificates</button>
            <button class="student-tab" data-tab="payments">Payment History</button>
        </div>

        <div class="tab-panel active" id="tab-courses">
        <div class="grid grid-3">
            @forelse($enrollments as $enrollment)
                <article class="card course-card">
                    <div class="student-course-image"><img src="{{ $enrollment->course->image_url }}" alt="{{ $enrollment->course->title }}"></div>
                    <span class="pill">{{ $enrollment->course->category->name ?? 'Course' }}</span>
                    <h2 style="font-size:26px">{{ $enrollment->course->title }}</h2>
                    <p class="muted">Payment: {{ ucfirst(str_replace('_', ' ', $enrollment->payment_status)) }}</p>
                    <div class="progress" style="margin:14px 0"><i style="width:{{ $enrollment->progress }}%"></i></div>
                    <p class="muted">{{ $enrollment->progress }}% complete</p>
                    <div style="margin-top:auto;display:flex;gap:10px;flex-wrap:wrap">
                        <a class="btn primary" href="{{ route('student.learn', $enrollment) }}">Continue</a>
                        @if($enrollment->certificate)
                            <a class="btn" href="{{ route('student.certificates.show', $enrollment->certificate) }}">Certificate</a>
                        @endif
                    </div>
                </article>
            @empty
                <div class="card">
                    <h2>No courses yet.</h2>
                    <p class="muted">Explore courses and enroll to start learning.</p>
                    <a class="btn primary" href="{{ route('courses.index') }}">Browse Courses</a>
                </div>
            @endforelse
        </div>
        </div>

        <div class="tab-panel" id="tab-certificates">
            <div class="grid grid-3">
                @forelse($enrollments->filter->certificate as $enrollment)
                    <div class="card">
                        <span class="pill">{{ $enrollment->certificate->certificate_id }}</span>
                        <h2 style="font-size:26px">{{ $enrollment->course->title }}</h2>
                        <p class="muted">Issued: {{ $enrollment->certificate->issued_at->format('d M Y') }}</p>
                        <a class="btn primary" href="{{ route('student.certificates.show', $enrollment->certificate) }}">Open Certificate</a>
                    </div>
                @empty
                    <div class="card"><h2>No certificates yet.</h2><p class="muted">Admin will upload certificate after course completion verification.</p></div>
                @endforelse
            </div>
        </div>

        <div class="tab-panel" id="tab-payments">
            <div class="card">
                @forelse($enrollments as $enrollment)
                    <div style="display:flex;justify-content:space-between;gap:12px;padding:14px 0;border-bottom:1px solid var(--line)">
                        <div><strong>{{ $enrollment->course->title }}</strong><p class="muted" style="margin:4px 0 0">{{ ucfirst(str_replace('_', ' ', $enrollment->payment_status)) }} / {{ $enrollment->transaction_id ?: 'No transaction ID' }}</p></div>
                        <span class="price">Rs. {{ number_format($enrollment->amount_paid, 0) }}</span>
                    </div>
                @empty
                    <p class="muted">No payment records yet.</p>
                @endforelse
            </div>
        </div>
    </div>
</section>
@endsection
