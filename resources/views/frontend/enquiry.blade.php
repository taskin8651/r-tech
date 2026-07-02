@extends('layouts.frontend')

@section('title', 'Admission Enquiry | R Tech Computer')

@section('content')

@php
    $settings = $settings ?? \App\Models\SiteSetting::current();

    $phone = $settings->phone ?: '';
    $whatsapp = $settings->whatsapp ?: $settings->phone;

    $phoneHref = preg_replace('/\s+/', '', $phone);
    $waDigits = preg_replace('/\D+/', '', $whatsapp ?: '');

    if(strlen($waDigits) === 10) {
        $waDigits = '91' . $waDigits;
    }

    $waText = urlencode('Hello, I want to enquire about R Tech Computer courses.');
@endphp

<section class="rt-enquiry-page">

    {{-- BACKGROUND DECORATION --}}
    <div class="rt-enquiry-bg" aria-hidden="true">
        <span class="rt-enquiry-grid"></span>
        <span class="rt-enquiry-glow rt-glow-one"></span>
        <span class="rt-enquiry-glow rt-glow-two"></span>
        <span class="rt-enquiry-ring rt-ring-one"></span>
        <span class="rt-enquiry-ring rt-ring-two"></span>
    </div>

    <div class="wrap rt-enquiry-wrap">

        @if(session('message'))
            <div class="rt-enquiry-alert">
                <span>✓</span>
                <strong>{{ session('message') }}</strong>
            </div>
        @endif

        {{-- HERO --}}
        <div class="rt-enquiry-hero">
            <div class="rt-enquiry-hero-content">
                <span class="rt-eyebrow">Admission Enquiry</span>
                <h1>Talk to R Tech Computer for your next course.</h1>
                <p>
                    Apna course enquiry submit karein. Institute team admin panel se aapki enquiry track karegi
                    aur fee, batch timing, syllabus, online learning aur certificate support ke baare me guide karegi.
                </p>

                <div class="rt-enquiry-actions">
                    @if($phoneHref)
                        <a href="tel:{{ $phoneHref }}" class="rt-enquiry-btn primary">
                            Call Now
                            <i>↗</i>
                        </a>
                    @endif

                    @if($waDigits)
                        <a href="https://wa.me/{{ $waDigits }}?text={{ $waText }}" target="_blank" rel="noopener" class="rt-enquiry-btn">
                            WhatsApp
                            <i>↗</i>
                        </a>
                    @endif
                </div>
            </div>

            <div class="rt-enquiry-hero-card">
                <div class="rt-logo-box">
                    @if($settings->logo_url)
                        <img src="{{ $settings->logo_url }}" alt="{{ $settings->site_name }}">
                    @else
                        <strong>RT</strong>
                    @endif
                </div>

                <h3>{{ $settings->site_name ?? 'R Tech Computer' }}</h3>
                <p>Course admission, online learning, student dashboard and certificate-based support.</p>

                <div class="rt-mini-list">
                    <div>
                        <span>01</span>
                        <strong>Course Guidance</strong>
                    </div>
                    <div>
                        <span>02</span>
                        <strong>Batch Details</strong>
                    </div>
                    <div>
                        <span>03</span>
                        <strong>Certificate Support</strong>
                    </div>
                </div>
            </div>
        </div>

        {{-- MAIN GRID --}}
        <div class="rt-enquiry-main">

            {{-- FORM --}}
            <div class="rt-enquiry-form-card">
                <div class="rt-card-head">
                    <span class="rt-pill">Submit Details</span>
                    <h2>Send your admission enquiry</h2>
                    <p>
                        Form submit karne ke baad institute team aapse phone/WhatsApp par contact karegi.
                    </p>
                </div>

                <form method="POST" action="{{ route('enquiry.store') }}" class="rt-enquiry-form">
                    @csrf

                    <div class="rt-form-grid">
                        <div class="rt-field">
                            <label>Full Name <span>*</span></label>
                            <input name="name" value="{{ old('name') }}" placeholder="Enter full name" required>
                            @error('name')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="rt-field">
                            <label>Phone / WhatsApp</label>
                            <input name="phone" value="{{ old('phone') }}" placeholder="Enter mobile number">
                            @error('phone')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="rt-field">
                            <label>Email Address</label>
                            <input name="email" value="{{ old('email') }}" placeholder="Enter email address">
                            @error('email')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="rt-field">
                            <label>Interested Course</label>
                            <select name="course_id">
                                <option value="">Select interested course</option>
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}" @selected(old('course_id', $selectedCourse->id ?? '') == $course->id)>
                                        {{ $course->title }}
                                    </option>
                                @endforeach
                            </select>
                            @error('course_id')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="rt-field">
                        <label>Message</label>
                        <textarea name="message" placeholder="Write your course requirement, preferred batch timing or any question">{{ old('message') }}</textarea>
                        @error('message')
                            <small>{{ $message }}</small>
                        @enderror
                    </div>

                    <button class="rt-submit-btn" type="submit">
                        Submit Enquiry
                        <span>→</span>
                    </button>
                </form>
            </div>

            {{-- SIDE PANEL --}}
            <aside class="rt-enquiry-side">
                <span class="rt-pill">Why Enquire?</span>
                <h2>Get proper guidance before joining.</h2>
                <p>
                    R Tech Computer team aapko course selection, admission process, fee, batch timing,
                    online access aur certificate ke baare me clear information provide karegi.
                </p>

                <div class="rt-benefit-list">
                    <div>
                        <span class="rt-benefit-icon">✓</span>
                        <div>
                            <strong>Course Selection Help</strong>
                            <p>Student ke goal ke according suitable computer course suggest kiya ja sakta hai.</p>
                        </div>
                    </div>

                    <div>
                        <span class="rt-benefit-icon">✓</span>
                        <div>
                            <strong>Fee & Duration Details</strong>
                            <p>Course fee, duration, discount, batch timing aur syllabus details mil sakti hain.</p>
                        </div>
                    </div>

                    <div>
                        <span class="rt-benefit-icon">✓</span>
                        <div>
                            <strong>Certificate Support</strong>
                            <p>Course completion ke baad certificate download aur verification support available hoga.</p>
                        </div>
                    </div>
                </div>

                <div class="rt-side-contact">
                    @if($phone)
                        <a href="tel:{{ $phoneHref }}">
                            <span>Phone</span>
                            <strong>{{ $phone }}</strong>
                        </a>
                    @endif

                    @if($whatsapp)
                        <a href="https://wa.me/{{ $waDigits }}?text={{ $waText }}" target="_blank" rel="noopener">
                            <span>WhatsApp</span>
                            <strong>{{ $whatsapp }}</strong>
                        </a>
                    @endif
                </div>
            </aside>
        </div>

        {{-- PROCESS --}}
        <div class="rt-enquiry-process">
            <div class="rt-process-card">
                <span>01</span>
                <h3>Submit Enquiry</h3>
                <p>Student apni basic details aur interested course submit karega.</p>
            </div>

            <div class="rt-process-card">
                <span>02</span>
                <h3>Admin Follow-up</h3>
                <p>Institute team admin panel se enquiry track karke contact karegi.</p>
            </div>

            <div class="rt-process-card">
                <span>03</span>
                <h3>Course Admission</h3>
                <p>Fee, batch, course access aur certificate process explain kiya jayega.</p>
            </div>
        </div>

    </div>
</section>

<style>
    .rt-enquiry-page {
        position: relative;
        padding: 110px 0 90px;
        overflow: hidden;
        background:
            radial-gradient(circle at 10% 0, rgba(35, 211, 255, .16), transparent 28rem),
            radial-gradient(circle at 92% 12%, rgba(110, 243, 203, .13), transparent 26rem),
            linear-gradient(180deg, rgba(7, 9, 25, 1), rgba(10, 14, 35, 1) 46%, rgba(7, 9, 25, 1));
    }

    .rt-enquiry-bg,
    .rt-enquiry-grid,
    .rt-enquiry-glow,
    .rt-enquiry-ring {
        position: absolute;
        pointer-events: none;
    }

    .rt-enquiry-bg {
        inset: 0;
        overflow: hidden;
    }

    .rt-enquiry-grid {
        inset: 0;
        background-image:
            linear-gradient(rgba(255,255,255,.035) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255,255,255,.035) 1px, transparent 1px);
        background-size: 58px 58px;
        mask-image: linear-gradient(180deg, transparent, #000 16%, #000 82%, transparent);
    }

    .rt-enquiry-glow {
        width: 360px;
        height: 360px;
        border-radius: 999px;
        filter: blur(22px);
        opacity: .5;
    }

    .rt-glow-one {
        top: 80px;
        left: -130px;
        background: rgba(35, 211, 255, .28);
    }

    .rt-glow-two {
        right: -140px;
        bottom: 140px;
        background: rgba(110, 243, 203, .22);
    }

    .rt-enquiry-ring {
        width: 230px;
        height: 230px;
        border-radius: 999px;
        border: 1px solid rgba(35, 211, 255, .14);
    }

    .rt-ring-one {
        top: 150px;
        right: 8%;
    }

    .rt-ring-two {
        bottom: 120px;
        left: 6%;
    }

    .rt-enquiry-wrap {
        position: relative;
        z-index: 2;
    }

    .rt-enquiry-alert {
        margin-bottom: 24px;
        padding: 15px 18px;
        border-radius: 18px;
        color: var(--ink, #fff);
        background: rgba(110, 243, 203, .10);
        border: 1px solid rgba(110, 243, 203, .24);
        display: flex;
        align-items: center;
        gap: 12px;
        box-shadow: 0 18px 60px rgba(0, 0, 0, .18);
    }

    .rt-enquiry-alert span {
        width: 34px;
        height: 34px;
        display: grid;
        place-items: center;
        border-radius: 12px;
        color: #06111a;
        background: linear-gradient(135deg, var(--cyan, #23d3ff), var(--mint, #6ef3cb));
        font-weight: 900;
    }

    .rt-enquiry-hero {
        display: grid;
        grid-template-columns: minmax(0, 1.45fr) minmax(310px, .55fr);
        gap: 28px;
        align-items: stretch;
        margin-bottom: 28px;
    }

    .rt-enquiry-hero-content,
    .rt-enquiry-hero-card,
    .rt-enquiry-form-card,
    .rt-enquiry-side,
    .rt-process-card {
        border: 1px solid rgba(255, 255, 255, .12);
        background:
            linear-gradient(145deg, rgba(255, 255, 255, .095), rgba(255, 255, 255, .045));
        box-shadow: 0 24px 90px rgba(0, 0, 0, .28);
        backdrop-filter: blur(22px);
        -webkit-backdrop-filter: blur(22px);
    }

    .rt-enquiry-hero-content {
        padding: 48px;
        border-radius: 34px;
        min-height: 360px;
    }

    .rt-eyebrow,
    .rt-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 13px;
        border-radius: 999px;
        color: var(--mint, #6ef3cb);
        background: rgba(35, 211, 255, .12);
        border: 1px solid rgba(35, 211, 255, .22);
        font-size: 12px;
        font-weight: 900;
        letter-spacing: .12em;
        text-transform: uppercase;
    }

    .rt-enquiry-hero h1 {
        max-width: 820px;
        margin: 18px 0 16px;
        color: var(--ink, #fff);
        font-size: clamp(38px, 6vw, 72px);
        line-height: .98;
        letter-spacing: -.06em;
        font-weight: 900;
    }

    .rt-enquiry-hero p,
    .rt-card-head p,
    .rt-enquiry-side p,
    .rt-benefit-list p,
    .rt-process-card p {
        color: var(--muted, rgba(255,255,255,.68));
        line-height: 1.8;
    }

    .rt-enquiry-hero-content > p {
        max-width: 760px;
        font-size: 17px;
    }

    .rt-enquiry-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-top: 30px;
    }

    .rt-enquiry-btn,
    .rt-submit-btn {
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

    .rt-enquiry-btn.primary,
    .rt-submit-btn {
        color: #06111a;
        border: 0;
        background: linear-gradient(135deg, var(--cyan, #23d3ff), var(--mint, #6ef3cb));
        box-shadow: 0 16px 42px rgba(35, 211, 255, .20);
    }

    .rt-enquiry-btn:hover,
    .rt-submit-btn:hover {
        transform: translateY(-3px);
        border-color: rgba(35, 211, 255, .35);
    }

    .rt-enquiry-hero-card {
        border-radius: 34px;
        padding: 30px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .rt-logo-box {
        width: 96px;
        height: 96px;
        display: grid;
        place-items: center;
        border-radius: 28px;
        overflow: hidden;
        margin-bottom: 22px;
        background: rgba(255, 255, 255, .08);
        border: 1px solid rgba(255, 255, 255, .14);
    }

    .rt-logo-box img {
        width: 82px;
        height: 82px;
        object-fit: contain;
    }

    .rt-logo-box strong {
        color: var(--cyan, #23d3ff);
        font-size: 26px;
        font-weight: 900;
    }

    .rt-enquiry-hero-card h3,
    .rt-card-head h2,
    .rt-enquiry-side h2,
    .rt-process-card h3 {
        color: var(--ink, #fff);
        font-weight: 900;
        letter-spacing: -.03em;
    }

    .rt-mini-list {
        display: grid;
        gap: 10px;
        margin-top: 22px;
    }

    .rt-mini-list div {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 13px;
        border-radius: 16px;
        background: rgba(255, 255, 255, .07);
        border: 1px solid rgba(255, 255, 255, .09);
    }

    .rt-mini-list span {
        width: 34px;
        height: 34px;
        display: grid;
        place-items: center;
        flex: 0 0 auto;
        border-radius: 12px;
        color: #06111a;
        background: linear-gradient(135deg, var(--cyan, #23d3ff), var(--mint, #6ef3cb));
        font-weight: 900;
        font-size: 12px;
    }

    .rt-mini-list strong {
        color: var(--ink, #fff);
    }

    .rt-enquiry-main {
        display: grid;
        grid-template-columns: minmax(0, 1.35fr) minmax(320px, .65fr);
        gap: 28px;
        align-items: stretch;
    }

    .rt-enquiry-form-card,
    .rt-enquiry-side {
        border-radius: 32px;
        padding: 34px;
    }

    .rt-card-head {
        margin-bottom: 26px;
    }

    .rt-card-head h2,
    .rt-enquiry-side h2 {
        margin: 14px 0 8px;
        font-size: 34px;
    }

    .rt-form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 18px;
    }

    .rt-field {
        display: grid;
        gap: 8px;
        margin-bottom: 18px;
    }

    .rt-field label {
        color: var(--ink, #fff);
        font-size: 13px;
        font-weight: 900;
    }

    .rt-field label span {
        color: var(--cyan, #23d3ff);
    }

    .rt-field input,
    .rt-field select,
    .rt-field textarea {
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

    .rt-field select option {
        background: #080b22;
        color: #fff;
    }

    .rt-field textarea {
        min-height: 150px;
        resize: vertical;
    }

    .rt-field input::placeholder,
    .rt-field textarea::placeholder {
        color: rgba(255, 255, 255, .42);
    }

    .rt-field input:focus,
    .rt-field select:focus,
    .rt-field textarea:focus {
        border-color: rgba(35, 211, 255, .46);
        box-shadow: 0 0 0 4px rgba(35, 211, 255, .08);
        background: rgba(255, 255, 255, .095);
    }

    .rt-field small {
        color: #ff8f8f;
        font-weight: 800;
    }

    .rt-submit-btn {
        border: 0;
        cursor: pointer;
        margin-top: 2px;
    }

    .rt-enquiry-side {
        position: relative;
        overflow: hidden;
    }

    .rt-enquiry-side::after {
        content: "";
        position: absolute;
        right: -100px;
        bottom: -100px;
        width: 240px;
        height: 240px;
        border-radius: 999px;
        background: rgba(35, 211, 255, .12);
        pointer-events: none;
    }

    .rt-benefit-list {
        display: grid;
        gap: 16px;
        margin-top: 24px;
        position: relative;
        z-index: 2;
    }

    .rt-benefit-list > div {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        padding: 16px;
        border-radius: 18px;
        background: rgba(255, 255, 255, .07);
        border: 1px solid rgba(255, 255, 255, .09);
    }

    .rt-benefit-icon {
        width: 34px;
        height: 34px;
        display: grid;
        place-items: center;
        border-radius: 12px;
        color: #06111a;
        background: linear-gradient(135deg, var(--cyan, #23d3ff), var(--mint, #6ef3cb));
        font-weight: 900;
        flex: 0 0 auto;
    }

    .rt-benefit-list strong {
        display: block;
        color: var(--ink, #fff);
        margin-bottom: 4px;
    }

    .rt-benefit-list p {
        margin: 0;
        font-size: 14px;
    }

    .rt-side-contact {
        display: grid;
        gap: 12px;
        margin-top: 24px;
        position: relative;
        z-index: 2;
    }

    .rt-side-contact a {
        padding: 15px;
        border-radius: 18px;
        text-decoration: none;
        color: var(--ink, #fff);
        background: rgba(255, 255, 255, .07);
        border: 1px solid rgba(255, 255, 255, .09);
        transition: .22s ease;
    }

    .rt-side-contact a:hover {
        transform: translateY(-2px);
        border-color: rgba(35, 211, 255, .32);
    }

    .rt-side-contact span {
        display: block;
        color: var(--muted, rgba(255,255,255,.68));
        font-size: 12px;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: .08em;
        margin-bottom: 4px;
    }

    .rt-side-contact strong {
        color: var(--ink, #fff);
    }

    .rt-enquiry-process {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 18px;
        margin-top: 28px;
    }

    .rt-process-card {
        border-radius: 26px;
        padding: 26px;
        transition: .28s ease;
    }

    .rt-process-card:hover {
        transform: translateY(-6px);
        border-color: rgba(35, 211, 255, .25);
    }

    .rt-process-card span {
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

    .rt-process-card h3 {
        margin-bottom: 8px;
        font-size: 22px;
    }

    .rt-process-card p {
        margin: 0;
    }

    @media (max-width: 1040px) {
        .rt-enquiry-hero,
        .rt-enquiry-main {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .rt-enquiry-page {
            padding: 92px 0 72px;
        }

        .rt-enquiry-hero-content,
        .rt-enquiry-hero-card,
        .rt-enquiry-form-card,
        .rt-enquiry-side {
            border-radius: 24px;
            padding: 22px;
        }

        .rt-enquiry-hero h1 {
            font-size: 40px;
        }

        .rt-enquiry-actions {
            align-items: stretch;
            flex-direction: column;
        }

        .rt-form-grid,
        .rt-enquiry-process {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 480px) {
        .rt-enquiry-page {
            padding-top: 86px;
        }

        .rt-enquiry-hero h1 {
            font-size: 34px;
        }

        .rt-card-head h2,
        .rt-enquiry-side h2 {
            font-size: 28px;
        }

        .rt-enquiry-btn,
        .rt-submit-btn {
            width: 100%;
        }
    }
</style>

@endsection