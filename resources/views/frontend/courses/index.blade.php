@extends('layouts.frontend')

@section('title', 'Courses | R Tech Computer')
@section('meta_description', 'Explore R Tech Computer courses with fees, duration, syllabus, student dashboard access and certificate workflow.')
@section('meta_keywords', 'computer courses, dca, tally, web designing, ms office, certificate courses')

@section('content')
<section class="hero-small">
    <div class="wrap">
        <div class="eyebrow">Dynamic Course Catalogue</div>
        <h1>Choose your computer course.</h1>
        <p class="muted">All courses shown here are managed from the admin panel. Add a course once and it appears on the frontend automatically.</p>
    </div>
</section>

<section class="page">
    <div class="wrap">
        <div class="category-chips">
            <a class="category-chip {{ request('category') ? '' : 'active' }}" href="{{ route('courses.index', request()->only('search')) }}">All Courses</a>
            @foreach($categories as $category)
                <a class="category-chip {{ request('category') === $category->slug ? 'active' : '' }}" href="{{ route('courses.index', array_filter(['category' => $category->slug, 'search' => request('search')])) }}">{{ $category->name }}</a>
            @endforeach
        </div>

        <form method="GET" class="card" style="margin-bottom:22px">
            <div class="grid grid-3">
                <input type="search" name="search" value="{{ request('search') }}" placeholder="Search course">
                <select name="category">
                    <option value="">All categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->slug }}" @selected(request('category') === $category->slug)>{{ $category->name }}</option>
                    @endforeach
                </select>
                <button class="btn primary" type="submit">Filter Courses</button>
            </div>
        </form>

        <div class="grid grid-3">
            @forelse($courses as $course)
                <article class="card course-card premium-course-card">
                    <a href="{{ route('courses.show', $course) }}" class="course-media">
                        <img src="{{ $course->image_url }}" alt="{{ $course->title }}">
                        <span class="pill course-badge">{{ $course->category->name ?? 'Computer Course' }}</span>
                    </a>
                    <div class="course-body">
                        <h2 style="font-size:26px">{{ $course->title }}</h2>
                        <p class="muted">{{ $course->short_description }}</p>
                        <div class="course-meta">
                            <span>{{ $course->duration ?: 'Flexible' }}</span>
                            <span>{{ $course->level ?: 'All levels' }}</span>
                            @if($course->has_certificate)<span>Certificate</span>@endif
                        </div>
                        <div class="course-action">
                            <span class="price">Rs. {{ number_format($course->display_price, 0) }}</span>
                            <a class="btn primary" href="{{ route('courses.show', $course) }}">View Course</a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="card">No active courses found. Add courses from admin panel.</div>
            @endforelse
        </div>

        <div style="margin-top:24px">{{ $courses->links() }}</div>
    </div>
</section>
@endsection
