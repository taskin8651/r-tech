@extends('layouts.frontend')

@section('title', 'Verify Certificate | R Tech Computer')
@section('meta_description', 'Verify R Tech Computer course completion certificate using certificate ID.')
@section('meta_keywords', 'R Tech Computer certificate verify, certificate verification, course certificate')

@section('content')

@php
    $settings = $settings ?? \App\Models\SiteSetting::current();

    $certificateId = request('certificate_id');
    $hasSearch = request()->filled('certificate_id');
    $isValid = $hasSearch && $certificate && ! $certificate->is_revoked;

    $studentName = $isValid ? (optional($certificate->user)->name ?? 'Student Name') : null;
    $courseTitle = $isValid ? (optional($certificate->course)->title ?? 'Course Name') : null;
    $issuedDate = $isValid ? (optional($certificate->issued_at)->format('d M Y') ?? 'Issue date pending') : null;
@endphp

<section class="verify-page">

    {{-- BACKGROUND DECORATION --}}
    <div class="verify-bg" aria-hidden="true">
        <span class="verify-grid"></span>
        <span class="verify-glow verify-glow-one"></span>
        <span class="verify-glow verify-glow-two"></span>
        <span class="verify-ring verify-ring-one"></span>
        <span class="verify-ring verify-ring-two"></span>
    </div>

    <div class="wrap verify-wrap">

        {{-- HERO --}}
        <div class="verify-hero">
            <div class="verify-hero-content">
                <span class="verify-eyebrow">Certificate Verification</span>
                <h1>Verify a course completion certificate instantly.</h1>
                <p>
                    R Tech Computer ke certificate ID ko enter karke student name, course name,
                    issue date aur certificate validity check karein.
                </p>

                <div class="verify-trust-row">
                    <div>
                        <strong>Secure</strong>
                        <span>Certificate ID</span>
                    </div>
                    <div>
                        <strong>Valid</strong>
                        <span>Student Record</span>
                    </div>
                    <div>
                        <strong>PDF</strong>
                        <span>Certificate View</span>
                    </div>
                </div>
            </div>

            <div class="verify-hero-card">
                <div class="verify-logo">
                    @if($settings->logo_url)
                        <img src="{{ $settings->logo_url }}" alt="{{ $settings->site_name }}">
                    @else
                        <strong>RT</strong>
                    @endif
                </div>

                <h3>{{ $settings->site_name ?? 'R Tech Computer' }}</h3>
                <p>Verified online course certificate system for student completion records.</p>

                <div class="verify-mini-badge">
                    <span></span>
                    Certificate verification active
                </div>
            </div>
        </div>

        {{-- VERIFY FORM --}}
        <div class="verify-form-card">
            <div class="verify-form-head">
                <div>
                    <span class="verify-pill">Enter Certificate ID</span>
                    <h2>Check certificate status</h2>
                    <p>Example: <strong>RTC-2026-XXXXXXXX</strong></p>
                </div>
            </div>

            <form method="GET" class="verify-form">
                <div class="verify-input-wrap">
                    <span class="verify-input-icon">
                        <svg viewBox="0 0 24 24">
                            <path d="M12 2 20 5v6c0 5-3.4 9.4-8 11-4.6-1.6-8-6-8-11V5l8-3Zm-1 13.2 6-6-1.4-1.4L11 12.4 8.4 9.8 7 11.2l4 4Z"/>
                        </svg>
                    </span>

                    <input
                        name="certificate_id"
                        value="{{ $certificateId }}"
                        placeholder="Enter certificate ID, e.g. RTC-2026-XXXXXXXX"
                        autocomplete="off"
                        required>
                </div>

                <button class="verify-submit" type="submit">
                    Verify Certificate
                    <span>→</span>
                </button>
            </form>
        </div>

        {{-- RESULT --}}
        @if($hasSearch)
            @if($isValid)
                <div class="verify-result-card valid">
                    <div class="verify-result-top">
                        <div>
                            <span class="verify-status valid">
                                <i>✓</i>
                                Valid Certificate
                            </span>

                            <h2>{{ $studentName }}</h2>
                            <p>
                                Successfully completed
                                <strong>{{ $courseTitle }}</strong>
                                from {{ $settings->site_name ?? 'R Tech Computer' }}.
                            </p>
                        </div>

                        <div class="verify-seal">
                            <svg viewBox="0 0 24 24">
                                <path d="M12 2 15 5.2l4.2-.4-.4 4.2L22 12l-3.2 3 .4 4.2-4.2-.4L12 22l-3-3.2-4.2.4.4-4.2L2 12l3.2-3-.4-4.2 4.2.4L12 2Zm-1.1 13.4 6-6-1.4-1.4-4.6 4.6-2.4-2.4-1.4 1.4 3.8 3.8Z"/>
                            </svg>
                        </div>
                    </div>

                    <div class="verify-certificate-preview">
                        <div class="cert-preview-head">
                            <div class="cert-preview-logo">
                                @if($settings->logo_url)
                                    <img src="{{ $settings->logo_url }}" alt="{{ $settings->site_name }}">
                                @else
                                    <strong>RT</strong>
                                @endif
                            </div>

                            <div>
                                <strong>{{ $settings->site_name ?? 'R Tech Computer' }}</strong>
                                <span>Course Completion Certificate</span>
                            </div>
                        </div>

                        <div class="cert-preview-body">
                            <span>Certificate of Completion</span>
                            <h3>{{ $studentName }}</h3>
                            <p>has successfully completed</p>
                            <h4>{{ $courseTitle }}</h4>
                        </div>

                        <div class="cert-preview-info">
                            <div>
                                <span>Certificate ID</span>
                                <strong id="certificateIdText">{{ $certificate->certificate_id }}</strong>
                            </div>

                            <div>
                                <span>Issued Date</span>
                                <strong>{{ $issuedDate }}</strong>
                            </div>

                            <div>
                                <span>Status</span>
                                <strong>Verified</strong>
                            </div>
                        </div>
                    </div>

                    <div class="verify-result-actions">
                        @if($certificate->file_url)
                            <a class="verify-action-btn primary" href="{{ $certificate->file_url }}" target="_blank" rel="noopener">
                                View Certificate
                                <span>↗</span>
                            </a>
                        @else
                            <div class="verify-file-note">
                                Certificate record is valid, but certificate file upload is pending.
                            </div>
                        @endif

                        <button type="button" class="verify-action-btn" onclick="copyCertificateId()">
                            Copy Certificate ID
                            <span>⧉</span>
                        </button>
                    </div>
                </div>
            @else
                <div class="verify-result-card invalid">
                    <div class="verify-result-top">
                        <div>
                            <span class="verify-status invalid">
                                <i>!</i>
                                Not Found
                            </span>

                            <h2>Certificate could not be verified.</h2>
                            <p>
                                Please check the certificate ID again. Agar phir bhi issue aa raha hai,
                                to R Tech Computer team se contact karein.
                            </p>
                        </div>

                        <div class="verify-seal invalid">
                            <svg viewBox="0 0 24 24">
                                <path d="M12 2a10 10 0 1 0 .1 0H12Zm1 15h-2v-2h2v2Zm0-4h-2V7h2v6Z"/>
                            </svg>
                        </div>
                    </div>

                    <div class="verify-invalid-box">
                        <span>Searched Certificate ID</span>
                        <strong>{{ $certificateId }}</strong>
                    </div>

                    <div class="verify-result-actions">
                        <a class="verify-action-btn primary" href="{{ route('enquiry.create') }}">
                            Contact Institute
                            <span>→</span>
                        </a>

                        <a class="verify-action-btn" href="{{ route('certificates.verify') }}">
                            Try Again
                            <span>↻</span>
                        </a>
                    </div>
                </div>
            @endif
        @endif

        {{-- INFO CARDS --}}
        <div class="verify-info-grid">
            <div class="verify-info-card">
                <span>01</span>
                <h3>Enter Certificate ID</h3>
                <p>Student certificate par printed certificate ID ko input field me enter karein.</p>
            </div>

            <div class="verify-info-card">
                <span>02</span>
                <h3>Check Record</h3>
                <p>System student name, course name, issue date aur certificate status verify karega.</p>
            </div>

            <div class="verify-info-card">
                <span>03</span>
                <h3>View Certificate</h3>
                <p>Valid certificate hone par uploaded PDF/image certificate view kiya ja sakta hai.</p>
            </div>
        </div>

    </div>
</section>

<style>
    .verify-page {
        position: relative;
        padding: 110px 0 90px;
        overflow: hidden;
        background:
            radial-gradient(circle at 10% 0, rgba(35, 211, 255, .16), transparent 28rem),
            radial-gradient(circle at 92% 12%, rgba(110, 243, 203, .13), transparent 26rem),
            linear-gradient(180deg, rgba(7, 9, 25, 1), rgba(10, 14, 35, 1) 46%, rgba(7, 9, 25, 1));
    }

    .verify-bg,
    .verify-grid,
    .verify-glow,
    .verify-ring {
        position: absolute;
        pointer-events: none;
    }

    .verify-bg {
        inset: 0;
        overflow: hidden;
    }

    .verify-grid {
        inset: 0;
        background-image:
            linear-gradient(rgba(255,255,255,.035) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255,255,255,.035) 1px, transparent 1px);
        background-size: 58px 58px;
        mask-image: linear-gradient(180deg, transparent, #000 16%, #000 82%, transparent);
    }

    .verify-glow {
        width: 360px;
        height: 360px;
        border-radius: 999px;
        filter: blur(22px);
        opacity: .5;
    }

    .verify-glow-one {
        top: 80px;
        left: -130px;
        background: rgba(35, 211, 255, .28);
    }

    .verify-glow-two {
        right: -140px;
        bottom: 140px;
        background: rgba(110, 243, 203, .22);
    }

    .verify-ring {
        width: 230px;
        height: 230px;
        border-radius: 999px;
        border: 1px solid rgba(35, 211, 255, .14);
    }

    .verify-ring-one {
        top: 150px;
        right: 8%;
    }

    .verify-ring-two {
        bottom: 120px;
        left: 6%;
    }

    .verify-wrap {
        position: relative;
        z-index: 2;
    }

    .verify-hero {
        display: grid;
        grid-template-columns: minmax(0, 1.45fr) minmax(310px, .55fr);
        gap: 28px;
        align-items: stretch;
        margin-bottom: 28px;
    }

    .verify-hero-content,
    .verify-hero-card,
    .verify-form-card,
    .verify-result-card,
    .verify-info-card {
        border: 1px solid rgba(255, 255, 255, .12);
        background:
            linear-gradient(145deg, rgba(255, 255, 255, .095), rgba(255, 255, 255, .045));
        box-shadow: 0 24px 90px rgba(0, 0, 0, .28);
        backdrop-filter: blur(22px);
        -webkit-backdrop-filter: blur(22px);
    }

    .verify-hero-content {
        padding: 48px;
        border-radius: 34px;
        min-height: 360px;
    }

    .verify-eyebrow,
    .verify-pill {
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

    .verify-hero h1 {
        max-width: 830px;
        margin: 18px 0 16px;
        color: var(--ink, #fff);
        font-size: clamp(38px, 6vw, 72px);
        line-height: .98;
        letter-spacing: -.06em;
        font-weight: 900;
    }

    .verify-hero p,
    .verify-form-head p,
    .verify-result-card p,
    .verify-info-card p,
    .verify-hero-card p {
        color: var(--muted, rgba(255,255,255,.68));
        line-height: 1.8;
    }

    .verify-hero-content > p {
        max-width: 760px;
        font-size: 17px;
    }

    .verify-trust-row {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 12px;
        margin-top: 30px;
    }

    .verify-trust-row div {
        padding: 16px;
        border-radius: 18px;
        background: rgba(255,255,255,.07);
        border: 1px solid rgba(255,255,255,.09);
    }

    .verify-trust-row strong {
        display: block;
        color: var(--ink, #fff);
        font-size: 18px;
        font-weight: 900;
    }

    .verify-trust-row span {
        display: block;
        margin-top: 4px;
        color: var(--muted, rgba(255,255,255,.68));
        font-size: 12px;
        font-weight: 800;
    }

    .verify-hero-card {
        border-radius: 34px;
        padding: 30px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .verify-logo {
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

    .verify-logo img {
        width: 82px;
        height: 82px;
        object-fit: contain;
    }

    .verify-logo strong {
        color: var(--cyan, #23d3ff);
        font-size: 26px;
        font-weight: 900;
    }

    .verify-hero-card h3,
    .verify-form-head h2,
    .verify-result-card h2,
    .verify-info-card h3 {
        color: var(--ink, #fff);
        font-weight: 900;
        letter-spacing: -.03em;
    }

    .verify-mini-badge {
        margin-top: 22px;
        padding: 13px 14px;
        border-radius: 16px;
        background: rgba(110, 243, 203, .10);
        border: 1px solid rgba(110, 243, 203, .18);
        color: var(--ink, #fff);
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: 900;
        font-size: 13px;
    }

    .verify-mini-badge span {
        width: 10px;
        height: 10px;
        border-radius: 999px;
        background: var(--mint, #6ef3cb);
        box-shadow: 0 0 0 6px rgba(110, 243, 203, .12);
    }

    .verify-form-card {
        border-radius: 32px;
        padding: 32px;
        margin-bottom: 28px;
    }

    .verify-form-head {
        margin-bottom: 22px;
    }

    .verify-form-head h2 {
        margin: 14px 0 7px;
        font-size: 34px;
    }

    .verify-form-head p {
        margin: 0;
    }

    .verify-form-head p strong {
        color: var(--ink, #fff);
    }

    .verify-form {
        display: grid;
        grid-template-columns: minmax(0, 1fr) auto;
        gap: 14px;
        align-items: center;
    }

    .verify-input-wrap {
        position: relative;
    }

    .verify-input-icon {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        width: 34px;
        height: 34px;
        display: grid;
        place-items: center;
        border-radius: 12px;
        color: #06111a;
        background: linear-gradient(135deg, var(--cyan, #23d3ff), var(--mint, #6ef3cb));
    }

    .verify-input-icon svg {
        width: 18px;
        height: 18px;
        fill: currentColor;
    }

    .verify-input-wrap input {
        width: 100%;
        min-height: 58px;
        border: 1px solid rgba(255, 255, 255, .12);
        border-radius: 18px;
        outline: none;
        background: rgba(255, 255, 255, .075);
        color: var(--ink, #fff);
        padding: 14px 16px 14px 64px;
        font: inherit;
        font-weight: 800;
        transition: .22s ease;
    }

    .verify-input-wrap input::placeholder {
        color: rgba(255, 255, 255, .42);
        font-weight: 700;
    }

    .verify-input-wrap input:focus {
        border-color: rgba(35, 211, 255, .46);
        box-shadow: 0 0 0 4px rgba(35, 211, 255, .08);
        background: rgba(255, 255, 255, .095);
    }

    .verify-submit,
    .verify-action-btn {
        min-height: 58px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 14px 22px;
        border-radius: 999px;
        color: #06111a;
        text-decoration: none;
        border: 0;
        cursor: pointer;
        background: linear-gradient(135deg, var(--cyan, #23d3ff), var(--mint, #6ef3cb));
        font-weight: 900;
        box-shadow: 0 16px 42px rgba(35, 211, 255, .20);
        white-space: nowrap;
        transition: .25s ease;
    }

    .verify-submit:hover,
    .verify-action-btn:hover {
        transform: translateY(-3px);
    }

    .verify-action-btn:not(.primary) {
        color: var(--ink, #fff);
        background: rgba(255, 255, 255, .08);
        border: 1px solid rgba(255, 255, 255, .13);
        box-shadow: none;
    }

    .verify-result-card {
        border-radius: 34px;
        padding: 34px;
        margin-bottom: 28px;
        position: relative;
        overflow: hidden;
    }

    .verify-result-card.valid {
        border-color: rgba(110, 243, 203, .24);
    }

    .verify-result-card.invalid {
        border-color: rgba(255, 143, 143, .25);
    }

    .verify-result-card::after {
        content: "";
        position: absolute;
        right: -100px;
        bottom: -110px;
        width: 260px;
        height: 260px;
        border-radius: 999px;
        background: rgba(35, 211, 255, .11);
        pointer-events: none;
    }

    .verify-result-card.invalid::after {
        background: rgba(255, 143, 143, .10);
    }

    .verify-result-top {
        position: relative;
        z-index: 2;
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 24px;
        margin-bottom: 24px;
    }

    .verify-status {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        padding: 8px 13px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 900;
        letter-spacing: .08em;
        text-transform: uppercase;
    }

    .verify-status i {
        width: 22px;
        height: 22px;
        display: grid;
        place-items: center;
        border-radius: 999px;
        font-style: normal;
    }

    .verify-status.valid {
        color: var(--mint, #6ef3cb);
        background: rgba(110, 243, 203, .10);
        border: 1px solid rgba(110, 243, 203, .20);
    }

    .verify-status.valid i {
        color: #06111a;
        background: var(--mint, #6ef3cb);
    }

    .verify-status.invalid {
        color: #ffaaaa;
        background: rgba(255, 143, 143, .10);
        border: 1px solid rgba(255, 143, 143, .20);
    }

    .verify-status.invalid i {
        color: #170607;
        background: #ffaaaa;
    }

    .verify-result-card h2 {
        margin: 16px 0 8px;
        font-size: clamp(30px, 4vw, 48px);
    }

    .verify-result-card p {
        max-width: 740px;
        margin: 0;
    }

    .verify-result-card p strong {
        color: var(--ink, #fff);
    }

    .verify-seal {
        width: 96px;
        height: 96px;
        display: grid;
        place-items: center;
        flex: 0 0 auto;
        border-radius: 30px;
        color: #06111a;
        background: linear-gradient(135deg, var(--cyan, #23d3ff), var(--mint, #6ef3cb));
        box-shadow: 0 16px 44px rgba(35, 211, 255, .22);
    }

    .verify-seal.invalid {
        background: linear-gradient(135deg, #ff8f8f, #ffce73);
        box-shadow: 0 16px 44px rgba(255, 143, 143, .18);
    }

    .verify-seal svg {
        width: 48px;
        height: 48px;
        fill: currentColor;
    }

    .verify-certificate-preview {
        position: relative;
        z-index: 2;
        border-radius: 28px;
        padding: 28px;
        background:
            linear-gradient(135deg, rgba(255,255,255,.92), rgba(245,250,255,.88));
        border: 1px solid rgba(255,255,255,.65);
        box-shadow: inset 0 0 0 2px rgba(35, 211, 255, .12);
        color: #071025;
    }

    .verify-certificate-preview::before {
        content: "";
        position: absolute;
        inset: 14px;
        border: 2px dashed rgba(35, 211, 255, .28);
        border-radius: 20px;
        pointer-events: none;
    }

    .cert-preview-head,
    .cert-preview-body,
    .cert-preview-info {
        position: relative;
        z-index: 2;
    }

    .cert-preview-head {
        display: flex;
        align-items: center;
        gap: 14px;
        padding-bottom: 18px;
        border-bottom: 1px solid rgba(7, 16, 37, .10);
    }

    .cert-preview-logo {
        width: 70px;
        height: 70px;
        display: grid;
        place-items: center;
        border-radius: 20px;
        overflow: hidden;
        background: #fff;
        border: 1px solid rgba(7, 16, 37, .10);
    }

    .cert-preview-logo img {
        width: 60px;
        height: 60px;
        object-fit: contain;
    }

    .cert-preview-logo strong {
        color: #071025;
        font-weight: 900;
    }

    .cert-preview-head strong {
        display: block;
        font-size: 18px;
        font-weight: 900;
        color: #071025;
    }

    .cert-preview-head span {
        display: block;
        margin-top: 3px;
        color: #5d6678;
        font-weight: 800;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: .08em;
    }

    .cert-preview-body {
        text-align: center;
        padding: 32px 0;
    }

    .cert-preview-body span {
        color: #5d6678;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: .12em;
        font-size: 12px;
    }

    .cert-preview-body h3 {
        margin: 14px 0 8px;
        color: #071025;
        font-size: clamp(28px, 4vw, 48px);
        line-height: 1;
        font-weight: 900;
        letter-spacing: -.04em;
    }

    .cert-preview-body p {
        color: #5d6678;
        margin: 0;
        max-width: none;
    }

    .cert-preview-body h4 {
        margin: 8px 0 0;
        color: #121f55;
        font-size: 22px;
        font-weight: 900;
    }

    .cert-preview-info {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 12px;
    }

    .cert-preview-info div {
        padding: 13px;
        border-radius: 16px;
        background: rgba(7, 16, 37, .055);
        border: 1px solid rgba(7, 16, 37, .08);
        text-align: center;
    }

    .cert-preview-info span {
        display: block;
        color: #5d6678;
        font-size: 11px;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: .08em;
    }

    .cert-preview-info strong {
        display: block;
        margin-top: 4px;
        color: #071025;
        font-size: 13px;
        word-break: break-word;
    }

    .verify-result-actions {
        position: relative;
        z-index: 2;
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
        margin-top: 24px;
    }

    .verify-file-note,
    .verify-invalid-box {
        padding: 14px 16px;
        border-radius: 16px;
        color: var(--ink, #fff);
        background: rgba(255, 255, 255, .07);
        border: 1px solid rgba(255, 255, 255, .10);
        font-weight: 800;
    }

    .verify-invalid-box {
        position: relative;
        z-index: 2;
        margin-top: 20px;
    }

    .verify-invalid-box span {
        display: block;
        color: var(--muted, rgba(255,255,255,.68));
        font-size: 12px;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: .08em;
        margin-bottom: 4px;
    }

    .verify-invalid-box strong {
        color: var(--ink, #fff);
        word-break: break-word;
    }

    .verify-info-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 18px;
        margin-top: 28px;
    }

    .verify-info-card {
        border-radius: 26px;
        padding: 26px;
        transition: .28s ease;
    }

    .verify-info-card:hover {
        transform: translateY(-6px);
        border-color: rgba(35, 211, 255, .25);
    }

    .verify-info-card > span {
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

    .verify-info-card h3 {
        margin-bottom: 8px;
        font-size: 22px;
    }

    .verify-info-card p {
        margin: 0;
    }

    @media (max-width: 1040px) {
        .verify-hero {
            grid-template-columns: 1fr;
        }

        .verify-info-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .verify-page {
            padding: 92px 0 72px;
        }

        .verify-hero-content,
        .verify-hero-card,
        .verify-form-card,
        .verify-result-card {
            border-radius: 24px;
            padding: 22px;
        }

        .verify-hero h1 {
            font-size: 40px;
        }

        .verify-trust-row,
        .verify-form,
        .cert-preview-info {
            grid-template-columns: 1fr;
        }

        .verify-submit,
        .verify-action-btn {
            width: 100%;
        }

        .verify-result-top {
            flex-direction: column;
        }

        .verify-seal {
            width: 78px;
            height: 78px;
            border-radius: 24px;
        }

        .verify-seal svg {
            width: 38px;
            height: 38px;
        }
    }

    @media (max-width: 480px) {
        .verify-page {
            padding-top: 86px;
        }

        .verify-hero h1 {
            font-size: 34px;
        }

        .verify-form-head h2 {
            font-size: 28px;
        }

        .verify-certificate-preview {
            padding: 20px;
            border-radius: 22px;
        }

        .cert-preview-head {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>

<script>
    function copyCertificateId() {
        const el = document.getElementById('certificateIdText');

        if (!el) return;

        const text = el.innerText.trim();

        if (navigator.clipboard) {
            navigator.clipboard.writeText(text);
            alert('Certificate ID copied: ' + text);
        } else {
            const input = document.createElement('input');
            input.value = text;
            document.body.appendChild(input);
            input.select();
            document.execCommand('copy');
            document.body.removeChild(input);
            alert('Certificate ID copied: ' + text);
        }
    }
</script>

@endsection