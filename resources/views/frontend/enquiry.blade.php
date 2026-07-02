@extends('layouts.frontend')

@section('title', 'Admission Enquiry | R Tech Computer')

@section('content')
<section class="page">
    <div class="wrap">
        @if(session('message'))<div class="alert">{{ session('message') }}</div>@endif
        <div class="hero-small" style="padding-top:20px">
            <div class="eyebrow">Admission Enquiry</div>
            <h1>Talk to R Tech Computer.</h1>
            <p class="muted">Send your course enquiry and the institute team can track it from admin panel.</p>
        </div>
        <form class="card" method="POST" action="{{ route('enquiry.store') }}">
            @csrf
            <div class="grid grid-2">
                <input name="name" value="{{ old('name') }}" placeholder="Full name" required>
                <input name="phone" value="{{ old('phone') }}" placeholder="Phone / WhatsApp">
                <input name="email" value="{{ old('email') }}" placeholder="Email">
                <select name="course_id">
                    <option value="">Interested course</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}" @selected(old('course_id', $selectedCourse?->id) == $course->id)>{{ $course->title }}</option>
                    @endforeach
                </select>
            </div>
            <textarea name="message" style="width:100%;min-height:140px;margin-top:18px;border:1px solid var(--line);border-radius:8px;background:rgba(255,255,255,.08);color:var(--ink);padding:12px" placeholder="Message">{{ old('message') }}</textarea>
            <button class="btn primary" style="margin-top:18px" type="submit">Submit Enquiry</button>
        </form>
    </div>
</section>
@endsection
