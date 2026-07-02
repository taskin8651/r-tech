@extends('layouts.frontend')

@section('title', 'Contact | R Tech Computer')
@section('meta_description', 'Contact R Tech Computer for admissions, course enquiries, WhatsApp, phone, address and timing.')
@section('meta_keywords', 'R Tech Computer contact, admission enquiry, computer course enquiry')

@section('content')

@php
    $settings = $settings ?? \App\Models\SiteSetting::current();

    $phone = $settings->phone ?: 'Add client number';
    $whatsapp = $settings->whatsapp ?: $settings->phone;
    $email = $settings->email ?: 'Add institute email';
    $address = $settings->address ?: 'Add institute address';
    $timing = $settings->timing ?: 'Mon-Sat, batch-wise';

    $phoneHref = preg_replace('/\s+/', '', $settings->phone ?: '');
    $waDigits = preg_replace('/\D+/', '', $whatsapp ?: '');

    if(strlen($waDigits) === 10) {
        $waDigits = '91' . $waDigits;
    }

    $waText = urlencode('Hello, I want to enquire about R Tech Computer courses.');
    $mapQuery = $settings->address ?: $settings->site_name;
@endphp

<section class="contact-page">

    {{-- BACKGROUND --}}
    <div class="contact-bg" aria-hidden="true">
        <span class="contact-grid"></span>
        <span class="contact-glow contact-glow-one"></span>
        <span class="contact-glow contact-glow-two"></span>
        <span class="contact-ring contact-ring-one"></span>
        <span class="contact-ring contact-ring-two"></span>
    </div>

    <div class="wrap contact-wrap">

        @if(session('message'))
            <div class="contact-alert">
                <span><i>✓</i></span>
                <strong>{{ session('message') }}</strong>
            </div>
        @endif

        {{-- HERO --}}
        <div class="contact-hero">
            <div class="contact-hero-left">
                <span class="contact-eyebrow">Contact & Admission</span>
                <h1>Start your course enquiry with R Tech Computer.</h1>
                <p>
                    Course admission, online learning, certificate download, fee details, batch timing
                    aur student support ke liye apni details submit karein. Admin team enquiry panel se follow-up karegi.
                </p>

                <div class="contact-hero-actions">
                    @if($phoneHref)
                        <a href="tel:{{ $phoneHref }}" class="contact-btn primary">
                            <span>Call Now</span>
                            <i>↗</i>
                        </a>
                    @endif

                    @if($waDigits)
                        <a href="https://wa.me/{{ $waDigits }}?text={{ $waText }}" target="_blank" rel="noopener" class="contact-btn">
                            <span>WhatsApp Enquiry</span>
                            <i>↗</i>
                        </a>
                    @endif
                </div>
            </div>

            <div class="contact-hero-card">
                <div class="contact-logo-box">
                    @if($settings->logo_url)
                        <img src="{{ $settings->logo_url }}" alt="{{ $settings->site_name }}">
                    @else
                        <strong>RT</strong>
                    @endif
                </div>
                <h3>{{ $settings->site_name }}</h3>
                <p>Practical computer courses, online course access and certificate-based learning support.</p>

                <div class="contact-mini-stats">
                    <div>
                        <strong>Online</strong>
                        <span>Course Access</span>
                    </div>
                    <div>
                        <strong>PDF</strong>
                        <span>Certificate</span>
                    </div>
                    <div>
                        <strong>Fast</strong>
                        <span>Enquiry Follow-up</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- QUICK CONTACT CARDS --}}
        <div class="contact-info-grid">
            <a href="{{ $phoneHref ? 'tel:' . $phoneHref : 'javascript:void(0)' }}" class="contact-info-card">
                <span class="contact-info-icon phone">
                    <svg viewBox="0 0 24 24"><path d="M6.6 10.8c1.4 2.8 3.8 5.2 6.6 6.6l2.2-2.2c.3-.3.8-.4 1.2-.3 1.3.4 2.6.6 4 .6.7 0 1.2.5 1.2 1.2v3.5c0 .7-.5 1.2-1.2 1.2C10.4 22 2 13.6 2 3.4 2 2.7 2.5 2.2 3.2 2.2h3.5c.7 0 1.2.5 1.2 1.2 0 1.4.2 2.7.6 4 .1.4 0 .9-.3 1.2l-1.6 2.2Z"/></svg>
                </span>
                <small>Phone Number</small>
                <strong>{{ $phone }}</strong>
            </a>

            <a href="{{ $waDigits ? 'https://wa.me/' . $waDigits . '?text=' . $waText : 'javascript:void(0)' }}" target="_blank" rel="noopener" class="contact-info-card">
                <span class="contact-info-icon whatsapp">
                    <svg viewBox="0 0 24 24"><path d="M20.5 3.5A11.8 11.8 0 0 0 12.1 0C5.7 0 .5 5.2.5 11.6c0 2 .5 4 1.6 5.8L.4 24l6.8-1.8c1.7.9 3.6 1.4 5.5 1.4h.1c6.4 0 11.6-5.2 11.6-11.6 0-3.1-1.2-6-3.4-8.2Zm-8.4 18c-1.7 0-3.3-.4-4.7-1.3l-.3-.2-4 1.1 1.1-3.9-.3-.4c-.9-1.5-1.4-3.2-1.4-5 0-5.3 4.3-9.6 9.6-9.6 2.6 0 5 1 6.8 2.8 1.8 1.8 2.8 4.2 2.8 6.8 0 5.4-4.3 9.7-9.6 9.7Z"/></svg>
                </span>
                <small>WhatsApp</small>
                <strong>{{ $whatsapp ?: 'Add WhatsApp number' }}</strong>
            </a>

            <a href="{{ $settings->email ? 'mailto:' . $settings->email : 'javascript:void(0)' }}" class="contact-info-card">
                <span class="contact-info-icon email">
                    <svg viewBox="0 0 24 24"><path d="M3 5h18a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1Zm9 8 8-5.5V7l-8 5.2L4 7v.5L12 13Z"/></svg>
                </span>
                <small>Email Address</small>
                <strong>{{ $email }}</strong>
            </a>

            <div class="contact-info-card">
                <span class="contact-info-icon timing">
                    <svg viewBox="0 0 24 24"><path d="M12 2a10 10 0 1 0 .1 0H12Zm1 11.6 4 2.4-1 1.7-5-3V6h2v7.6Z"/></svg>
                </span>
                <small>Institute Timing</small>
                <strong>{{ $timing }}</strong>
            </div>
        </div>

        {{-- FORM + DETAILS --}}
        <div class="contact-main-grid">

            {{-- FORM --}}
            <div class="contact-form-card">
                <div class="contact-card-head">
                    <span class="contact-pill">Admission Form</span>
                    <h2>Submit your enquiry</h2>
                    <p>Fill the details below and our team will contact you for admission, fee and batch information.</p>
                </div>

                <form method="POST" action="{{ route('enquiry.store') }}" class="contact-form">
                    @csrf

                    <div class="contact-form-grid">
                        <div class="contact-field">
                            <label>Full Name <span>*</span></label>
                            <input name="name" value="{{ old('name') }}" placeholder="Enter full name" required>
                            @error('name') <small class="contact-error">{{ $message }}</small> @enderror
                        </div>

                        <div class="contact-field">
                            <label>Phone / WhatsApp</label>
                            <input name="phone" value="{{ old('phone') }}" placeholder="Enter mobile number">
                            @error('phone') <small class="contact-error">{{ $message }}</small> @enderror
                        </div>

                        <div class="contact-field">
                            <label>Email Address</label>
                            <input name="email" value="{{ old('email') }}" placeholder="Enter email address">
                            @error('email') <small class="contact-error">{{ $message }}</small> @enderror
                        </div>

                        <div class="contact-field">
                            <label>Interested Course</label>
                            <select name="course_id">
                                <option value="">Select interested course</option>
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}" @selected(old('course_id', $selectedCourse->id ?? '') == $course->id)>
                                        {{ $course->title }}
                                    </option>
                                @endforeach
                            </select>
                            @error('course_id') <small class="contact-error">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <div class="contact-field">
                        <label>Message</label>
                        <textarea name="message" placeholder="Write your message, course requirement or preferred batch timing">{{ old('message') }}</textarea>
                        @error('message') <small class="contact-error">{{ $message }}</small> @enderror
                    </div>

                    <button class="contact-submit" type="submit">
                        Submit Enquiry
                        <span>→</span>
                    </button>
                </form>
            </div>

            {{-- SIDE INFO --}}
            <aside class="contact-side-card">
                <span class="contact-pill">Institute Info</span>
                <h2>{{ $settings->site_name }}</h2>
                <p>
                    {{ $settings->about_intro ?: 'Computer training institute for practical courses, online learning and certificate-based student records.' }}
                </p>

                <div class="contact-detail-list">
                    <div>
                        <span>Address</span>
                        <strong>{{ $address }}</strong>
                    </div>

                    <div>
                        <span>Timing</span>
                        <strong>{{ $timing }}</strong>
                    </div>

                    <div>
                        <span>Admission Support</span>
                        <strong>Course enquiry, fee details, certificate support and batch guidance.</strong>
                    </div>
                </div>

                <div class="contact-socials">
                    @if($settings->facebook_url)
                        <a href="{{ $settings->facebook_url }}" target="_blank" rel="noopener">Facebook</a>
                    @endif

                    @if($settings->instagram_url)
                        <a href="{{ $settings->instagram_url }}" target="_blank" rel="noopener">Instagram</a>
                    @endif

                    @if($settings->youtube_url)
                        <a href="{{ $settings->youtube_url }}" target="_blank" rel="noopener">YouTube</a>
                    @endif

                    @if($settings->linkedin_url)
                        <a href="{{ $settings->linkedin_url }}" target="_blank" rel="noopener">LinkedIn</a>
                    @endif
                </div>
            </aside>
        </div>

        {{-- MAP --}}
        <div class="contact-map-section">
            <div class="contact-map-head">
                <div>
                    <span class="contact-eyebrow">Location Map</span>
                    <h2>Visit our institute</h2>
                    <p>{{ $address }}</p>
                </div>

                <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($mapQuery) }}" target="_blank" rel="noopener" class="contact-btn">
                    Open Google Map
                    <i>↗</i>
                </a>
            </div>

            <div class="contact-map-box">
                <iframe
                    src="https://www.google.com/maps?q={{ urlencode($mapQuery) }}&output=embed"
                    width="100%"
                    height="430"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>

        {{-- HELP CARDS --}}
        <div class="contact-help-grid">
            <div class="contact-help-card">
                <span>01</span>
                <h3>Course Admission</h3>
                <p>Course fee, duration, batch timing, syllabus and admission process ke liye enquiry submit karein.</p>
            </div>

            <div class="contact-help-card">
                <span>02</span>
                <h3>Online Course Access</h3>
                <p>Student dashboard, course videos, PDF notes and learning progress related help mil sakti hai.</p>
            </div>

            <div class="contact-help-card">
                <span>03</span>
                <h3>Certificate Support</h3>
                <p>Course completion certificate, PDF download aur certificate verification ke liye support available hoga.</p>
            </div>
        </div>

    </div>
</section>

<style>
    .contact-page {
        position: relative;
        padding: 108px 0 90px;
        overflow: hidden;
        background:
            radial-gradient(circle at 8% 5%, rgba(35, 211, 255, .14), transparent 28rem),
            radial-gradient(circle at 92% 10%, rgba(110, 243, 203, .12), transparent 26rem),
            linear-gradient(180deg, rgba(7, 9, 25, 1), rgba(10, 14, 35, 1) 42%, rgba(7, 9, 25, 1));
    }

    .contact-bg,
    .contact-grid,
    .contact-glow,
    .contact-ring {
        position: absolute;
        pointer-events: none;
    }

    .contact-bg {
        inset: 0;
        overflow: hidden;
    }

    .contact-grid {
        inset: 0;
        background-image:
            linear-gradient(rgba(255,255,255,.035) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255,255,255,.035) 1px, transparent 1px);
        background-size: 58px 58px;
        mask-image: linear-gradient(180deg, transparent, #000 16%, #000 80%, transparent);
    }

    .contact-glow {
        width: 360px;
        height: 360px;
        border-radius: 999px;
        filter: blur(20px);
        opacity: .5;
    }

    .contact-glow-one {
        top: 80px;
        left: -130px;
        background: rgba(35, 211, 255, .28);
    }

    .contact-glow-two {
        right: -140px;
        top: 360px;
        background: rgba(110, 243, 203, .22);
    }

    .contact-ring {
        width: 220px;
        height: 220px;
        border: 1px solid rgba(35, 211, 255, .14);
        border-radius: 999px;
    }

    .contact-ring-one {
        top: 160px;
        right: 8%;
    }

    .contact-ring-two {
        bottom: 170px;
        left: 6%;
    }

    .contact-wrap {
        position: relative;
        z-index: 2;
    }

    .contact-alert {
        margin-bottom: 24px;
        padding: 15px 18px;
        border: 1px solid rgba(110, 243, 203, .22);
        border-radius: 18px;
        background: rgba(110, 243, 203, .10);
        color: var(--ink, #fff);
        display: flex;
        align-items: center;
        gap: 12px;
        box-shadow: 0 18px 60px rgba(0, 0, 0, .18);
    }

    .contact-alert span {
        width: 34px;
        height: 34px;
        display: grid;
        place-items: center;
        border-radius: 12px;
        color: #06111a;
        background: linear-gradient(135deg, var(--cyan, #23d3ff), var(--mint, #6ef3cb));
    }

    .contact-hero {
        display: grid;
        grid-template-columns: minmax(0, 1.45fr) minmax(320px, .55fr);
        gap: 28px;
        align-items: stretch;
        margin-bottom: 28px;
    }

    .contact-hero-left,
    .contact-hero-card,
    .contact-form-card,
    .contact-side-card,
    .contact-map-section,
    .contact-help-card,
    .contact-info-card {
        border: 1px solid rgba(255, 255, 255, .12);
        background:
            linear-gradient(145deg, rgba(255, 255, 255, .095), rgba(255, 255, 255, .045));
        box-shadow: 0 24px 90px rgba(0, 0, 0, .28);
        backdrop-filter: blur(22px);
        -webkit-backdrop-filter: blur(22px);
    }

    .contact-hero-left {
        padding: 48px;
        border-radius: 34px;
        min-height: 360px;
    }

    .contact-eyebrow,
    .contact-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 13px;
        border-radius: 999px;
        background: rgba(35, 211, 255, .12);
        border: 1px solid rgba(35, 211, 255, .22);
        color: var(--mint, #6ef3cb);
        font-size: 12px;
        font-weight: 900;
        letter-spacing: .12em;
        text-transform: uppercase;
    }

    .contact-hero h1 {
        margin: 18px 0 16px;
        max-width: 820px;
        color: var(--ink, #fff);
        font-size: clamp(38px, 6vw, 72px);
        line-height: .98;
        letter-spacing: -.06em;
        font-weight: 900;
    }

    .contact-hero p,
    .contact-card-head p,
    .contact-side-card p,
    .contact-map-head p,
    .contact-help-card p {
        color: var(--muted, rgba(255,255,255,.68));
        line-height: 1.8;
    }

    .contact-hero-left > p {
        max-width: 740px;
        font-size: 17px;
    }

    .contact-hero-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-top: 30px;
    }

    .contact-btn,
    .contact-submit {
        min-height: 48px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 13px 20px;
        border-radius: 999px;
        color: var(--ink, #fff);
        text-decoration: none;
        border: 1px solid rgba(255, 255, 255, .13);
        background: rgba(255, 255, 255, .08);
        font-weight: 900;
        transition: .25s ease;
    }

    .contact-btn.primary,
    .contact-submit {
        color: #06111a;
        border: 0;
        background: linear-gradient(135deg, var(--cyan, #23d3ff), var(--mint, #6ef3cb));
        box-shadow: 0 16px 42px rgba(35, 211, 255, .20);
    }

    .contact-btn:hover,
    .contact-submit:hover {
        transform: translateY(-3px);
        color: var(--ink, #fff);
        border-color: rgba(35, 211, 255, .35);
    }

    .contact-btn.primary:hover,
    .contact-submit:hover {
        color: #06111a;
    }

    .contact-hero-card {
        border-radius: 34px;
        padding: 30px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .contact-logo-box {
        width: 96px;
        height: 96px;
        display: grid;
        place-items: center;
        border-radius: 28px;
        background: rgba(255, 255, 255, .08);
        border: 1px solid rgba(255, 255, 255, .14);
        margin-bottom: 22px;
        overflow: hidden;
    }

    .contact-logo-box img {
        width: 82px;
        height: 82px;
        object-fit: contain;
    }

    .contact-logo-box strong {
        color: var(--cyan, #23d3ff);
        font-size: 26px;
        font-weight: 900;
    }

    .contact-hero-card h3,
    .contact-form-card h2,
    .contact-side-card h2,
    .contact-map-head h2,
    .contact-help-card h3 {
        color: var(--ink, #fff);
        font-weight: 900;
        letter-spacing: -.03em;
    }

    .contact-mini-stats {
        display: grid;
        gap: 10px;
        margin-top: 22px;
    }

    .contact-mini-stats div {
        padding: 13px;
        border-radius: 16px;
        background: rgba(255, 255, 255, .07);
        border: 1px solid rgba(255, 255, 255, .09);
    }

    .contact-mini-stats strong {
        display: block;
        color: var(--ink, #fff);
    }

    .contact-mini-stats span {
        display: block;
        margin-top: 2px;
        color: var(--muted, rgba(255,255,255,.68));
        font-size: 12px;
        font-weight: 800;
    }

    .contact-info-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        margin-bottom: 28px;
    }

    .contact-info-card {
        padding: 22px;
        border-radius: 24px;
        color: var(--ink, #fff);
        text-decoration: none;
        transition: .28s ease;
    }

    .contact-info-card:hover {
        transform: translateY(-6px);
        border-color: rgba(35, 211, 255, .28);
    }

    .contact-info-icon {
        width: 52px;
        height: 52px;
        display: grid;
        place-items: center;
        border-radius: 18px;
        margin-bottom: 16px;
        color: #06111a;
        background: linear-gradient(135deg, var(--cyan, #23d3ff), var(--mint, #6ef3cb));
    }

    .contact-info-icon svg {
        width: 22px;
        height: 22px;
        fill: currentColor;
    }

    .contact-info-icon.whatsapp {
        color: #fff;
        background: linear-gradient(135deg, #25d366, #128c7e);
    }

    .contact-info-icon.email {
        color: #06111a;
        background: linear-gradient(135deg, #ffd166, #ff9f1c);
    }

    .contact-info-icon.timing {
        color: #fff;
        background: linear-gradient(135deg, #7c4dff, #23d3ff);
    }

    .contact-info-card small {
        display: block;
        color: var(--muted, rgba(255,255,255,.68));
        font-weight: 800;
        margin-bottom: 5px;
    }

    .contact-info-card strong {
        display: block;
        color: var(--ink, #fff);
        font-size: 15px;
        line-height: 1.5;
        word-break: break-word;
    }

    .contact-main-grid {
        display: grid;
        grid-template-columns: minmax(0, 1.35fr) minmax(320px, .65fr);
        gap: 28px;
        align-items: stretch;
    }

    .contact-form-card,
    .contact-side-card {
        border-radius: 32px;
        padding: 34px;
    }

    .contact-card-head {
        margin-bottom: 26px;
    }

    .contact-card-head h2,
    .contact-side-card h2 {
        margin: 14px 0 8px;
        font-size: 34px;
    }

    .contact-form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 18px;
    }

    .contact-field {
        display: grid;
        gap: 8px;
        margin-bottom: 18px;
    }

    .contact-field label {
        color: var(--ink, #fff);
        font-size: 13px;
        font-weight: 900;
    }

    .contact-field label span {
        color: var(--cyan, #23d3ff);
    }

    .contact-field input,
    .contact-field select,
    .contact-field textarea {
        width: 100%;
        min-height: 52px;
        border: 1px solid rgba(255, 255, 255, .12);
        border-radius: 16px;
        outline: none;
        background: rgba(255, 255, 255, .075);
        color: var(--ink, #fff);
        padding: 13px 15px;
        font: inherit;
        transition: .22s ease;
    }

    .contact-field select option {
        background: #080b22;
        color: #fff;
    }

    .contact-field textarea {
        min-height: 150px;
        resize: vertical;
    }

    .contact-field input::placeholder,
    .contact-field textarea::placeholder {
        color: rgba(255, 255, 255, .42);
    }

    .contact-field input:focus,
    .contact-field select:focus,
    .contact-field textarea:focus {
        border-color: rgba(35, 211, 255, .46);
        box-shadow: 0 0 0 4px rgba(35, 211, 255, .08);
        background: rgba(255, 255, 255, .095);
    }

    .contact-error {
        color: #ff8f8f;
        font-weight: 800;
    }

    .contact-submit {
        border: 0;
        cursor: pointer;
        margin-top: 2px;
    }

    .contact-side-card {
        position: relative;
        overflow: hidden;
    }

    .contact-side-card::after {
        content: "";
        position: absolute;
        right: -90px;
        bottom: -100px;
        width: 230px;
        height: 230px;
        border-radius: 999px;
        background: rgba(35, 211, 255, .12);
        pointer-events: none;
    }

    .contact-detail-list {
        display: grid;
        gap: 12px;
        margin-top: 22px;
        position: relative;
        z-index: 2;
    }

    .contact-detail-list div {
        padding: 15px;
        border-radius: 18px;
        background: rgba(255, 255, 255, .07);
        border: 1px solid rgba(255, 255, 255, .09);
    }

    .contact-detail-list span {
        display: block;
        color: var(--muted, rgba(255,255,255,.68));
        font-size: 12px;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: .08em;
        margin-bottom: 5px;
    }

    .contact-detail-list strong {
        display: block;
        color: var(--ink, #fff);
        line-height: 1.55;
    }

    .contact-socials {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 22px;
        position: relative;
        z-index: 2;
    }

    .contact-socials a {
        padding: 9px 12px;
        border-radius: 999px;
        color: var(--ink, #fff);
        text-decoration: none;
        font-weight: 900;
        font-size: 12px;
        background: rgba(255, 255, 255, .08);
        border: 1px solid rgba(255, 255, 255, .10);
        transition: .22s ease;
    }

    .contact-socials a:hover {
        transform: translateY(-2px);
        border-color: rgba(35, 211, 255, .35);
    }

    .contact-map-section {
        margin-top: 28px;
        border-radius: 32px;
        padding: 28px;
    }

    .contact-map-head {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 20px;
    }

    .contact-map-head h2 {
        margin: 12px 0 6px;
        font-size: 34px;
    }

    .contact-map-head p {
        margin: 0;
    }

    .contact-map-box {
        overflow: hidden;
        border-radius: 24px;
        border: 1px solid rgba(255, 255, 255, .13);
        background: rgba(255, 255, 255, .06);
    }

    .contact-map-box iframe {
        display: block;
        width: 100%;
        filter: saturate(1.08) contrast(1.03);
    }

    .contact-help-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 18px;
        margin-top: 28px;
    }

    .contact-help-card {
        border-radius: 26px;
        padding: 26px;
        transition: .28s ease;
    }

    .contact-help-card:hover {
        transform: translateY(-6px);
        border-color: rgba(35, 211, 255, .25);
    }

    .contact-help-card span {
        width: 46px;
        height: 46px;
        display: grid;
        place-items: center;
        border-radius: 16px;
        color: #06111a;
        background: linear-gradient(135deg, var(--cyan, #23d3ff), var(--mint, #6ef3cb));
        font-weight: 900;
        margin-bottom: 18px;
    }

    .contact-help-card h3 {
        margin-bottom: 8px;
        font-size: 22px;
    }

    .contact-help-card p {
        margin: 0;
    }

    @media (max-width: 1040px) {
        .contact-hero,
        .contact-main-grid {
            grid-template-columns: 1fr;
        }

        .contact-info-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .contact-page {
            padding: 92px 0 72px;
        }

        .contact-hero-left,
        .contact-hero-card,
        .contact-form-card,
        .contact-side-card,
        .contact-map-section {
            border-radius: 24px;
            padding: 22px;
        }

        .contact-hero h1 {
            font-size: 40px;
        }

        .contact-hero-actions,
        .contact-map-head {
            align-items: stretch;
            flex-direction: column;
        }

        .contact-info-grid,
        .contact-form-grid,
        .contact-help-grid {
            grid-template-columns: 1fr;
        }

        .contact-map-box iframe {
            height: 330px;
        }
    }

    @media (max-width: 480px) {
        .contact-page {
            padding-top: 86px;
        }

        .contact-hero h1 {
            font-size: 34px;
        }

        .contact-card-head h2,
        .contact-side-card h2,
        .contact-map-head h2 {
            font-size: 28px;
        }

        .contact-btn,
        .contact-submit {
            width: 100%;
        }
    }
</style>

@endsection