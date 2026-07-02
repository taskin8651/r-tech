@extends('layouts.frontend')

@section('title', $course->meta_title ?: $course->title . ' | R Tech Computer')
@section('meta_description', $course->meta_description ?: ($course->short_description ?: 'Course details, syllabus, enrollment and certificate information.'))
@section('meta_keywords', $course->meta_keywords ?: $course->title . ', computer course, certificate course')
@section('meta_image', $course->image_url)

@section('content')
<section class="hero-small">
    <div class="wrap">
        <div class="eyebrow">{{ $course->category->name ?? 'Course Detail' }}</div>
        <h1>{{ $course->title }}</h1>
        <p class="muted">{{ $course->short_description }}</p>
        <div style="display:flex;gap:12px;flex-wrap:wrap;margin-top:22px">
            <span class="pill">{{ $course->duration ?: 'Flexible duration' }}</span>
            <span class="pill">{{ $course->level ?: 'All levels' }}</span>
            @if($course->has_certificate)<span class="pill">Certificate included</span>@endif
        </div>
        <div class="detail-visual" style="margin-top:28px">
            <img src="{{ $course->image_url }}" alt="{{ $course->title }}">
        </div>
    </div>
</section>

<section class="page">
    <div class="wrap grid grid-2">
        <div>
            <div class="card" style="margin-bottom:18px">
                <h2>Course overview</h2>
                <p class="muted">{!! nl2br(e($course->description ?: $course->short_description)) !!}</p>
            </div>
            <div class="card">
                <h2>Syllabus</h2>
                @forelse($course->modules as $module)
                    <div style="padding:16px 0;border-bottom:1px solid var(--line)">
                        <strong>{{ $module->title }}</strong>
                        <p class="muted">{{ $module->description }}</p>
                        @foreach($module->lessons as $lesson)
                            <p class="muted" style="margin:8px 0 0">- {{ $lesson->title }} @if($lesson->is_preview)(Preview)@endif</p>
                        @endforeach
                    </div>
                @empty
                    <p class="muted">Syllabus will be updated soon.</p>
                @endforelse
            </div>
        </div>
        <aside class="card" style="height:max-content;position:sticky;top:96px">
            <div class="side-image"><img src="{{ $course->image_url }}" alt="{{ $course->title }}"></div>
            <span class="pill">Enrollment</span>
            <h2>Rs. {{ number_format($course->display_price, 0) }}</h2>
            @if($course->discount_price)
                <p class="muted"><del>Rs. {{ number_format($course->price, 0) }}</del> discounted fee</p>
            @endif
            @auth
                @if(config('services.razorpay.key') && $course->display_price > 0)
                    <a class="btn primary" style="width:100%;margin-top:16px" href="{{ route('student.courses.checkout', $course) }}">Pay & Enroll</a>
                @else
                    <form method="POST" action="{{ route('student.courses.enroll', $course) }}">
                        @csrf
                        <button class="btn primary" style="width:100%;margin-top:16px" type="submit">Enroll Now</button>
                    </form>
                @endif
            @else
                <a class="btn primary" style="width:100%;margin-top:16px" href="{{ route('login') }}">Login to Enroll</a>
            @endauth
            <a class="btn" style="width:100%;margin-top:10px" href="{{ route('enquiry.create', ['course' => $course->slug]) }}">Send Enquiry</a>
            <a class="btn" style="width:100%;margin-top:10px" href="{{ route('certificates.verify') }}">Verify Certificate</a>
        </aside>
    </div>
</section>
@endsection
