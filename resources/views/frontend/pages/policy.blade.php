@extends('layouts.frontend')

@section('title', $title . ' | R Tech Computer')
@section('meta_description', $intro)
@section('meta_keywords', strtolower($title) . ', R Tech Computer policy')

@section('content')

@php
    $settings = $settings ?? \App\Models\SiteSetting::current();
@endphp

<section class="rt-policy-page">

    <div class="rt-policy-bg" aria-hidden="true">
        <span class="rt-policy-grid"></span>
        <span class="rt-policy-glow rt-policy-glow-one"></span>
        <span class="rt-policy-glow rt-policy-glow-two"></span>
        <span class="rt-policy-ring rt-policy-ring-one"></span>
        <span class="rt-policy-ring rt-policy-ring-two"></span>
    </div>

    <div class="wrap rt-policy-wrap">

        {{-- HERO --}}
        <div class="rt-policy-hero">
            <div class="rt-policy-hero-content">
                <span class="rt-policy-eyebrow">Policy Document</span>
                <h1>{{ $title }}</h1>
                <p>{{ $intro }}</p>

                <div class="rt-policy-meta">
                    <div>
                        <span>Institute</span>
                        <strong>{{ $settings->site_name ?? 'R Tech Computer' }}</strong>
                    </div>
                    <div>
                        <span>Last Updated</span>
                        <strong>{{ now()->format('d M Y') }}</strong>
                    </div>
                    <div>
                        <span>Status</span>
                        <strong>Active Policy</strong>
                    </div>
                </div>
            </div>

            <div class="rt-policy-side-card">
                <div class="rt-policy-logo">
                    @if($settings->logo_url)
                        <img src="{{ $settings->logo_url }}" alt="{{ $settings->site_name }}">
                    @else
                        <strong>RT</strong>
                    @endif
                </div>

                <h3>{{ $settings->site_name ?? 'R Tech Computer' }}</h3>
                <p>
                    Practical computer courses, online learning access, student dashboard
                    and certificate support.
                </p>

                <div class="rt-policy-mini-list">
                    <a href="{{ route('privacy') }}">Privacy Policy</a>
                    <a href="{{ route('terms') }}">Terms & Conditions</a>
                    <a href="{{ route('refund') }}">Refund Policy</a>
                </div>
            </div>
        </div>

        {{-- POLICY CONTENT --}}
        <div class="rt-policy-main">
            <aside class="rt-policy-toc">
                <span class="rt-policy-pill">Quick Links</span>
                <a href="{{ route('privacy') }}" class="{{ request()->routeIs('privacy') ? 'active' : '' }}">Privacy Policy</a>
                <a href="{{ route('terms') }}" class="{{ request()->routeIs('terms') ? 'active' : '' }}">Terms & Conditions</a>
                <a href="{{ route('refund') }}" class="{{ request()->routeIs('refund') ? 'active' : '' }}">Refund Policy</a>
                <a href="{{ route('contact') }}">Contact Support</a>
                <a href="{{ route('enquiry.create') }}">Admission Enquiry</a>
            </aside>

            <article class="rt-policy-card">
                <div class="rt-policy-card-head">
                    <span class="rt-policy-pill">Official Information</span>
                    <h2>{{ $title }}</h2>
                    <p>{{ $intro }}</p>
                </div>

                <div class="rt-policy-content">
                    @if(filled($body))
                        {!! $body !!}
                    @else
                        <div class="rt-policy-empty">
                            <h3>Policy content will be updated soon.</h3>
                            <p>Please contact {{ $settings->site_name ?? 'R Tech Computer' }} for more details.</p>
                        </div>
                    @endif
                </div>
            </article>
        </div>

        {{-- SUPPORT STRIP --}}
        <div class="rt-policy-support">
            <div>
                <span class="rt-policy-eyebrow">Need Help?</span>
                <h2>Have questions about this policy?</h2>
                <p>Contact our institute team for admission, course access, payment or certificate-related support.</p>
            </div>

            <div class="rt-policy-support-actions">
                <a href="{{ route('contact') }}" class="rt-policy-btn primary">Contact Us <span>→</span></a>
                <a href="{{ route('enquiry.create') }}" class="rt-policy-btn">Send Enquiry <span>↗</span></a>
            </div>
        </div>

    </div>
</section>

<style>
    .rt-policy-page {
        position: relative;
        padding: 110px 0 90px;
        overflow: hidden;
        background:
            radial-gradient(circle at 10% 0, rgba(35, 211, 255, .16), transparent 28rem),
            radial-gradient(circle at 92% 12%, rgba(110, 243, 203, .13), transparent 26rem),
            linear-gradient(180deg, rgba(7, 9, 25, 1), rgba(10, 14, 35, 1) 46%, rgba(7, 9, 25, 1));
    }

    .rt-policy-bg,
    .rt-policy-grid,
    .rt-policy-glow,
    .rt-policy-ring {
        position: absolute;
        pointer-events: none;
    }

    .rt-policy-bg {
        inset: 0;
        overflow: hidden;
    }

    .rt-policy-grid {
        inset: 0;
        background-image:
            linear-gradient(rgba(255,255,255,.035) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255,255,255,.035) 1px, transparent 1px);
        background-size: 58px 58px;
        mask-image: linear-gradient(180deg, transparent, #000 16%, #000 82%, transparent);
    }

    .rt-policy-glow {
        width: 360px;
        height: 360px;
        border-radius: 999px;
        filter: blur(22px);
        opacity: .5;
    }

    .rt-policy-glow-one {
        top: 80px;
        left: -130px;
        background: rgba(35, 211, 255, .28);
    }

    .rt-policy-glow-two {
        right: -140px;
        bottom: 140px;
        background: rgba(110, 243, 203, .22);
    }

    .rt-policy-ring {
        width: 230px;
        height: 230px;
        border-radius: 999px;
        border: 1px solid rgba(35, 211, 255, .14);
    }

    .rt-policy-ring-one {
        top: 150px;
        right: 8%;
    }

    .rt-policy-ring-two {
        bottom: 120px;
        left: 6%;
    }

    .rt-policy-wrap {
        position: relative;
        z-index: 2;
    }

    .rt-policy-hero {
        display: grid;
        grid-template-columns: minmax(0, 1.4fr) minmax(300px, .6fr);
        gap: 28px;
        align-items: stretch;
        margin-bottom: 28px;
    }

    .rt-policy-hero-content,
    .rt-policy-side-card,
    .rt-policy-toc,
    .rt-policy-card,
    .rt-policy-support {
        border: 1px solid rgba(255, 255, 255, .12);
        background: linear-gradient(145deg, rgba(255, 255, 255, .095), rgba(255, 255, 255, .045));
        box-shadow: 0 24px 90px rgba(0, 0, 0, .28);
        backdrop-filter: blur(22px);
        -webkit-backdrop-filter: blur(22px);
    }

    .rt-policy-hero-content {
        padding: 48px;
        border-radius: 34px;
    }

    .rt-policy-eyebrow,
    .rt-policy-pill {
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

    .rt-policy-hero h1 {
        max-width: 850px;
        margin: 18px 0 16px;
        color: var(--ink, #fff);
        font-size: clamp(38px, 6vw, 72px);
        line-height: .98;
        letter-spacing: -.06em;
        font-weight: 900;
    }

    .rt-policy-hero p,
    .rt-policy-side-card p,
    .rt-policy-card-head p,
    .rt-policy-support p,
    .rt-policy-content p,
    .rt-policy-content li {
        color: var(--muted, rgba(255,255,255,.68));
        line-height: 1.85;
    }

    .rt-policy-meta {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 12px;
        margin-top: 30px;
    }

    .rt-policy-meta div {
        padding: 16px;
        border-radius: 18px;
        background: rgba(255,255,255,.07);
        border: 1px solid rgba(255,255,255,.09);
    }

    .rt-policy-meta span {
        display: block;
        color: var(--muted, rgba(255,255,255,.68));
        font-size: 11px;
        font-weight: 900;
        letter-spacing: .1em;
        text-transform: uppercase;
        margin-bottom: 5px;
    }

    .rt-policy-meta strong {
        color: var(--ink, #fff);
        font-weight: 900;
    }

    .rt-policy-side-card {
        border-radius: 34px;
        padding: 30px;
    }

    .rt-policy-logo {
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

    .rt-policy-logo img {
        width: 82px;
        height: 82px;
        object-fit: contain;
    }

    .rt-policy-logo strong {
        color: var(--cyan, #23d3ff);
        font-size: 26px;
        font-weight: 900;
    }

    .rt-policy-side-card h3,
    .rt-policy-card-head h2,
    .rt-policy-support h2,
    .rt-policy-content h2,
    .rt-policy-content h3,
    .rt-policy-content h4 {
        color: var(--ink, #fff);
        font-weight: 900;
        letter-spacing: -.03em;
    }

    .rt-policy-mini-list {
        display: grid;
        gap: 10px;
        margin-top: 22px;
    }

    .rt-policy-mini-list a,
    .rt-policy-toc a {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 13px 14px;
        border-radius: 16px;
        color: var(--ink, #fff);
        text-decoration: none;
        background: rgba(255,255,255,.07);
        border: 1px solid rgba(255,255,255,.09);
        font-weight: 900;
        transition: .25s ease;
    }

    .rt-policy-mini-list a::after,
    .rt-policy-toc a::after {
        content: "→";
        color: var(--mint, #6ef3cb);
    }

    .rt-policy-mini-list a:hover,
    .rt-policy-toc a:hover,
    .rt-policy-toc a.active {
        transform: translateY(-2px);
        border-color: rgba(35, 211, 255, .32);
        background: rgba(35, 211, 255, .10);
    }

    .rt-policy-main {
        display: grid;
        grid-template-columns: 280px minmax(0, 1fr);
        gap: 28px;
        align-items: flex-start;
    }

    .rt-policy-toc {
        position: sticky;
        top: 100px;
        border-radius: 28px;
        padding: 22px;
        display: grid;
        gap: 10px;
    }

    .rt-policy-toc .rt-policy-pill {
        margin-bottom: 8px;
    }

    .rt-policy-card {
        border-radius: 32px;
        padding: 36px;
    }

    .rt-policy-card-head {
        margin-bottom: 28px;
        padding-bottom: 24px;
        border-bottom: 1px solid rgba(255,255,255,.10);
    }

    .rt-policy-card-head h2 {
        margin: 14px 0 8px;
        font-size: 34px;
    }

    .rt-policy-content {
        color: var(--muted, rgba(255,255,255,.68));
    }

    .rt-policy-content h2 {
        margin: 30px 0 12px;
        font-size: 28px;
    }

    .rt-policy-content h3 {
        margin: 24px 0 10px;
        font-size: 22px;
    }

    .rt-policy-content p {
        margin: 0 0 16px;
    }

    .rt-policy-content ul,
    .rt-policy-content ol {
        margin: 0 0 22px;
        padding-left: 22px;
    }

    .rt-policy-content li {
        margin-bottom: 10px;
    }

    .rt-policy-content strong {
        color: var(--ink, #fff);
    }

    .rt-policy-content a {
        color: var(--mint, #6ef3cb);
        font-weight: 900;
    }

    .rt-policy-empty {
        padding: 24px;
        border-radius: 20px;
        background: rgba(255,255,255,.07);
        border: 1px solid rgba(255,255,255,.10);
    }

    .rt-policy-empty h3 {
        margin: 0 0 8px;
    }

    .rt-policy-support {
        margin-top: 28px;
        border-radius: 32px;
        padding: 32px;
        display: grid;
        grid-template-columns: minmax(0, 1fr) auto;
        gap: 24px;
        align-items: center;
    }

    .rt-policy-support h2 {
        margin: 14px 0 8px;
        font-size: clamp(28px, 4vw, 44px);
    }

    .rt-policy-support-actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        justify-content: flex-end;
    }

    .rt-policy-btn {
        min-height: 48px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 13px 18px;
        border-radius: 999px;
        color: var(--ink, #fff);
        text-decoration: none;
        border: 1px solid rgba(255,255,255,.13);
        background: rgba(255,255,255,.08);
        font-weight: 900;
        transition: .25s ease;
    }

    .rt-policy-btn.primary {
        color: #06111a;
        border: 0;
        background: linear-gradient(135deg, var(--cyan, #23d3ff), var(--mint, #6ef3cb));
        box-shadow: 0 16px 42px rgba(35, 211, 255, .20);
    }

    .rt-policy-btn:hover {
        transform: translateY(-3px);
    }

    @media (max-width: 1040px) {
        .rt-policy-hero,
        .rt-policy-main,
        .rt-policy-support {
            grid-template-columns: 1fr;
        }

        .rt-policy-toc {
            position: relative;
            top: auto;
        }

        .rt-policy-support-actions {
            justify-content: flex-start;
        }
    }

    @media (max-width: 768px) {
        .rt-policy-page {
            padding: 92px 0 72px;
        }

        .rt-policy-hero-content,
        .rt-policy-side-card,
        .rt-policy-toc,
        .rt-policy-card,
        .rt-policy-support {
            border-radius: 24px;
            padding: 22px;
        }

        .rt-policy-hero h1 {
            font-size: 40px;
        }

        .rt-policy-meta {
            grid-template-columns: 1fr;
        }

        .rt-policy-btn {
            width: 100%;
        }
    }

    @media (max-width: 480px) {
        .rt-policy-page {
            padding-top: 86px;
        }

        .rt-policy-hero h1 {
            font-size: 34px;
        }

        .rt-policy-card-head h2 {
            font-size: 28px;
        }

        .rt-policy-content h2 {
            font-size: 24px;
        }
    }
</style>

@endsection