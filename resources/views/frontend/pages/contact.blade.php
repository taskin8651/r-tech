@extends('layouts.frontend')

@section('title', 'Contact | R Tech Computer')
@section('meta_description', 'Contact R Tech Computer for admissions, course enquiries, WhatsApp, phone, address and timing.')
@section('meta_keywords', 'R Tech Computer contact, admission enquiry, computer course enquiry')

@section('content')
<section class="page">
    <div class="wrap">
        @if(session('message'))<div class="alert">{{ session('message') }}</div>@endif
        <div class="hero-small" style="padding-top:20px">
            <div class="eyebrow">Contact & Admission</div>
            <h1>Start your course enquiry.</h1>
            <p class="muted">Send your details and the admin team can follow up from the enquiry panel.</p>
        </div>

        <div class="grid grid-2">
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

            <div class="card">
                <span class="pill">Institute Info</span>
                <h2>{{ $settings->site_name }}</h2>
                <p class="muted">Computer training institute for practical courses, online learning and certificate-based student records.</p>
                <div style="display:grid;gap:12px;margin-top:18px">
                    <div class="card" style="padding:14px">Phone: {{ $settings->phone ?: 'Add client number' }}</div>
                    <div class="card" style="padding:14px">WhatsApp: {{ $settings->whatsapp ?: 'Add WhatsApp number' }}</div>
                    <div class="card" style="padding:14px">Email: {{ $settings->email ?: 'Add institute email' }}</div>
                    <div class="card" style="padding:14px">Address: {{ $settings->address ?: 'Add institute address' }}</div>
                    <div class="card" style="padding:14px">Timing: {{ $settings->timing ?: 'Mon-Sat, batch-wise' }}</div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
