@php
    $siteSettings = $siteSettings ?? \App\Models\SiteSetting::current();

    $phone = $siteSettings->phone ?: '';
    $whatsapp = $siteSettings->whatsapp ?: $siteSettings->phone;
    $email = $siteSettings->email ?: '';
    $address = $siteSettings->address ?: '';
    $timing = $siteSettings->timing ?: 'Mon-Sat, batch-wise';

    $phoneHref = preg_replace('/\s+/', '', $phone);
    $waDigits = preg_replace('/\D+/', '', $whatsapp ?: '');

    if(strlen($waDigits) === 10) {
        $waDigits = '91' . $waDigits;
    }

    $waText = urlencode('Hello, I want to enquire about R Tech Computer courses.');
@endphp

<footer class="site-footer">
    <div class="footer-bg" aria-hidden="true">
        <span class="footer-grid"></span>
        <span class="footer-glow footer-glow-one"></span>
        <span class="footer-glow footer-glow-two"></span>
        <span class="footer-ring footer-ring-one"></span>
        <span class="footer-ring footer-ring-two"></span>
    </div>

    <div class="wrap">

        {{-- PREMIUM TOP CTA --}}
        <div class="footer-cta">
            <div class="footer-cta-content">
                <span class="footer-eyebrow">Start Learning Today</span>
                <h2>Build practical computer skills with online course access and certificate support.</h2>
                <p>
                    Course enquiry, admission guidance, batch timing, online learning access aur certificate
                    verification ke liye R Tech Computer team se connect karein.
                </p>
            </div>

            <div class="footer-cta-actions">
                <a href="{{ route('courses.index') }}" class="footer-btn primary">
                    Explore Courses
                    <span>→</span>
                </a>

                <a href="{{ route('enquiry.create') }}" class="footer-btn">
                    Send Enquiry
                    <span>↗</span>
                </a>
            </div>
        </div>

        {{-- MAIN FOOTER --}}
        <div class="site-footer-inner premium-footer-inner">

            {{-- BRAND --}}
            <div class="footer-brand-col">
                <a href="{{ route('landing') }}" class="footer-brand">
                    <span class="footer-logo">
                        @if($siteSettings->logo_url)
                            <img src="{{ $siteSettings->logo_url }}" alt="{{ $siteSettings->site_name }}">
                        @else
                            <strong>RT</strong>
                        @endif
                    </span>

                    <span>
                        <strong>{{ $siteSettings->site_name }}</strong>
                        <small>Online Course & Certificate Platform</small>
                    </span>
                </a>

                <p>
                    {{ $siteSettings->about_intro ?: 'Practical computer courses, skill training, online learning and certificate support for students.' }}
                </p>

                <div class="footer-contact-pills">
                    @if($phone)
                        <a href="tel:{{ $phoneHref }}">
                            <span>Call</span>
                            {{ $phone }}
                        </a>
                    @endif

                    @if($waDigits)
                        <a href="https://wa.me/{{ $waDigits }}?text={{ $waText }}" target="_blank" rel="noopener">
                            <span>WhatsApp</span>
                            {{ $whatsapp }}
                        </a>
                    @endif

                    @if($email)
                        <a href="mailto:{{ $email }}">
                            <span>Email</span>
                            {{ $email }}
                        </a>
                    @endif
                </div>
            </div>

            {{-- QUICK LINKS --}}
            <div class="footer-link-col">
                <h3>Quick Links</h3>
                <nav class="site-footer-links footer-link-stack">
                    <a href="{{ route('landing') }}">Home</a>
                    <a href="{{ route('about') }}">About</a>
                    <a href="{{ route('courses.index') }}">Courses</a>
                    <a href="{{ route('enquiry.create') }}">Admission Enquiry</a>
                    <a href="{{ route('contact') }}">Contact</a>
                    <a href="{{ route('certificates.verify') }}">Verify Certificate</a>
                </nav>
            </div>

            {{-- COURSE LINKS --}}
            <div class="footer-link-col">
                <h3>Popular Courses</h3>
                <nav class="site-footer-links footer-link-stack">
                    <a href="{{ route('courses.index') }}">Basic Computer</a>
                    <a href="{{ route('courses.index') }}">DCA / ADCA</a>
                    <a href="{{ route('courses.index') }}">Tally & GST</a>
                    <a href="{{ route('courses.index') }}">DTP</a>
                    <a href="{{ route('courses.index') }}">Web Designing</a>
                    <a href="{{ route('courses.index') }}">Digital Skills</a>
                </nav>
            </div>

            {{-- INFO --}}
            <div class="footer-info-col">
                <h3>Institute Info</h3>

                <div class="footer-info-list">
                    <div>
                        <span>Timing</span>
                        <strong>{{ $timing }}</strong>
                    </div>

                    @if($address)
                        <div>
                            <span>Address</span>
                            <strong>{{ $address }}</strong>
                        </div>
                    @endif
                </div>

                <div class="footer-socials">
                    @if($siteSettings->facebook_url)
                        <a href="{{ $siteSettings->facebook_url }}" target="_blank" rel="noopener">Facebook</a>
                    @endif

                    @if($siteSettings->instagram_url)
                        <a href="{{ $siteSettings->instagram_url }}" target="_blank" rel="noopener">Instagram</a>
                    @endif

                    @if($siteSettings->youtube_url)
                        <a href="{{ $siteSettings->youtube_url }}" target="_blank" rel="noopener">YouTube</a>
                    @endif

                    @if($siteSettings->linkedin_url)
                        <a href="{{ $siteSettings->linkedin_url }}" target="_blank" rel="noopener">LinkedIn</a>
                    @endif
                </div>
            </div>
        </div>

        {{-- BOTTOM BAR --}}
        <div class="footer-bottom">
            <p>© {{ date('Y') }} {{ $siteSettings->site_name }}. All Rights Reserved.</p>

            <nav>
                <a href="{{ route('privacy') }}">Privacy</a>
                <a href="{{ route('terms') }}">Terms</a>
                <a href="{{ route('refund') }}">Refund</a>
            </nav>
        </div>
    </div>
</footer>

{{-- MOBILE INSTAGRAM STYLE BOTTOM NAV --}}
<nav class="mobile-bottom-nav" aria-label="Mobile Bottom Navigation">
    <a href="{{ route('landing') }}" class="mobile-bottom-link {{ request()->routeIs('landing') ? 'active' : '' }}">
        <span class="mobile-bottom-icon">
            <svg viewBox="0 0 24 24">
                <path d="M3 11.2 12 4l9 7.2V21a1 1 0 0 1-1 1h-5v-7H9v7H4a1 1 0 0 1-1-1v-9.8Z"/>
            </svg>
        </span>
        <span>Home</span>
    </a>

    <a href="{{ route('courses.index') }}" class="mobile-bottom-link {{ request()->routeIs('courses.*') ? 'active' : '' }}">
        <span class="mobile-bottom-icon">
            <svg viewBox="0 0 24 24">
                <path d="M5 4h11a4 4 0 0 1 4 4v12H8a3 3 0 0 1-3-3V4Zm3 3v8h9V8a1 1 0 0 0-1-1H8Z"/>
            </svg>
        </span>
        <span>Courses</span>
    </a>

    <a href="{{ route('enquiry.create') }}" class="mobile-bottom-link is-center {{ request()->routeIs('enquiry.*') ? 'active' : '' }}">
        <span class="mobile-bottom-icon">
            <svg viewBox="0 0 24 24">
                <path d="M11 5h2v6h6v2h-6v6h-2v-6H5v-2h6V5Z"/>
            </svg>
        </span>
        <span>Enquiry</span>
    </a>

    <a href="{{ route('certificates.verify') }}" class="mobile-bottom-link {{ request()->routeIs('certificates.*') ? 'active' : '' }}">
        <span class="mobile-bottom-icon">
            <svg viewBox="0 0 24 24">
                <path d="M12 2 20 5v6c0 5-3.4 9.4-8 11-4.6-1.6-8-6-8-11V5l8-3Zm-1 13.2 6-6-1.4-1.4L11 12.4 8.4 9.8 7 11.2l4 4Z"/>
            </svg>
        </span>
        <span>Verify</span>
    </a>

    @auth
        <a href="{{ route(auth()->user()->is_admin ? 'admin.home' : 'student.dashboard') }}"
           class="mobile-bottom-link {{ request()->routeIs('admin.home') || request()->routeIs('student.dashboard') ? 'active' : '' }}">
            <span class="mobile-bottom-icon">
                <svg viewBox="0 0 24 24">
                    <path d="M4 4h7v7H4V4Zm9 0h7v7h-7V4ZM4 13h7v7H4v-7Zm9 0h7v7h-7v-7Z"/>
                </svg>
            </span>
            <span>Panel</span>
        </a>
    @else
        <a href="{{ route('login') }}" class="mobile-bottom-link {{ request()->routeIs('login') ? 'active' : '' }}">
            <span class="mobile-bottom-icon">
                <svg viewBox="0 0 24 24">
                    <path d="M12 12a5 5 0 1 0-5-5 5 5 0 0 0 5 5Zm0 2c-4.4 0-8 2.2-8 5v1h16v-1c0-2.8-3.6-5-8-5Z"/>
                </svg>
            </span>
            <span>Login</span>
        </a>
    @endauth
</nav>

<style>
    .site-footer {
        position: relative;
        z-index: 2;
        overflow: hidden;
        padding: 76px 0 28px;
        background:
            radial-gradient(circle at 10% 0, rgba(35, 211, 255, .14), transparent 24rem),
            radial-gradient(circle at 90% 100%, rgba(110, 243, 203, .12), transparent 24rem),
            linear-gradient(180deg, rgba(9, 12, 32, .98), rgba(5, 7, 20, 1));
        border-top: 1px solid rgba(255, 255, 255, .11);
        color: var(--ink, #fff);
    }

    .footer-bg,
    .footer-grid,
    .footer-glow,
    .footer-ring {
        position: absolute;
        pointer-events: none;
    }

    .footer-bg {
        inset: 0;
        overflow: hidden;
    }

    .footer-grid {
        inset: 0;
        background-image:
            linear-gradient(rgba(255,255,255,.035) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255,255,255,.035) 1px, transparent 1px);
        background-size: 58px 58px;
        mask-image: linear-gradient(180deg, #000, transparent 88%);
    }

    .footer-glow {
        width: 360px;
        height: 360px;
        border-radius: 999px;
        filter: blur(24px);
        opacity: .45;
    }

    .footer-glow-one {
        left: -150px;
        top: 40px;
        background: rgba(35, 211, 255, .25);
    }

    .footer-glow-two {
        right: -150px;
        bottom: -60px;
        background: rgba(110, 243, 203, .20);
    }

    .footer-ring {
        width: 210px;
        height: 210px;
        border-radius: 999px;
        border: 1px solid rgba(35, 211, 255, .13);
    }

    .footer-ring-one {
        top: 70px;
        right: 8%;
    }

    .footer-ring-two {
        bottom: 70px;
        left: 8%;
    }

    .site-footer > .wrap {
        position: relative;
        z-index: 2;
    }

    .footer-cta {
        display: grid;
        grid-template-columns: minmax(0, 1fr) auto;
        align-items: center;
        gap: 24px;
        padding: 32px;
        margin-bottom: 34px;
        border-radius: 30px;
        background:
            radial-gradient(circle at 12% 0, rgba(35, 211, 255, .18), transparent 20rem),
            linear-gradient(145deg, rgba(255,255,255,.105), rgba(255,255,255,.045));
        border: 1px solid rgba(255,255,255,.13);
        box-shadow: 0 26px 90px rgba(0,0,0,.30);
        backdrop-filter: blur(22px);
        -webkit-backdrop-filter: blur(22px);
    }

    .footer-eyebrow {
        display: inline-flex;
        align-items: center;
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

    .footer-cta h2 {
        max-width: 760px;
        margin: 16px 0 10px;
        color: var(--ink, #fff);
        font-size: clamp(28px, 4vw, 48px);
        line-height: 1.04;
        letter-spacing: -.05em;
        font-weight: 900;
    }

    .footer-cta p {
        max-width: 760px;
        margin: 0;
        color: var(--muted, rgba(255,255,255,.68));
        line-height: 1.8;
    }

    .footer-cta-actions {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        flex-wrap: wrap;
        gap: 12px;
    }

    .footer-btn {
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
        white-space: nowrap;
        transition: .25s ease;
    }

    .footer-btn.primary {
        color: #06111a;
        border: 0;
        background: linear-gradient(135deg, var(--cyan, #23d3ff), var(--mint, #6ef3cb));
        box-shadow: 0 16px 42px rgba(35, 211, 255, .20);
    }

    .footer-btn:hover {
        transform: translateY(-3px);
        color: var(--ink, #fff);
        border-color: rgba(35, 211, 255, .32);
    }

    .footer-btn.primary:hover {
        color: #06111a;
    }

    .premium-footer-inner {
        display: grid;
        grid-template-columns: minmax(280px, 1.35fr) .7fr .7fr 1fr;
        align-items: flex-start;
        gap: 28px;
        padding: 34px;
        border-radius: 30px;
        background:
            linear-gradient(145deg, rgba(255,255,255,.075), rgba(255,255,255,.035));
        border: 1px solid rgba(255,255,255,.10);
        box-shadow: 0 22px 80px rgba(0,0,0,.22);
        backdrop-filter: blur(18px);
        -webkit-backdrop-filter: blur(18px);
    }

    .footer-brand {
        display: inline-flex;
        align-items: center;
        gap: 14px;
        text-decoration: none;
        color: var(--ink, #fff);
        margin-bottom: 18px;
    }

    .footer-logo {
        width: 62px;
        height: 62px;
        display: grid;
        place-items: center;
        flex: 0 0 auto;
        border-radius: 20px;
        overflow: hidden;
        background:
            linear-gradient(145deg, rgba(255,255,255,.14), rgba(255,255,255,.055));
        border: 1px solid rgba(255,255,255,.16);
        box-shadow: 0 16px 42px rgba(0,0,0,.24);
        position: relative;
    }

    .footer-logo::after {
        content: "";
        position: absolute;
        inset: -40%;
        background: linear-gradient(120deg, transparent 35%, rgba(35,211,255,.30), transparent 65%);
        transform: translateX(-85%) rotate(18deg);
        animation: footerLogoShine 5s ease-in-out infinite;
    }

    @keyframes footerLogoShine {
        0%, 62%, 100% {
            transform: translateX(-85%) rotate(18deg);
        }

        75% {
            transform: translateX(85%) rotate(18deg);
        }
    }

    .footer-logo img,
    .footer-logo strong {
        width: 52px;
        height: 52px;
        display: grid;
        place-items: center;
        object-fit: contain;
        color: var(--cyan, #23d3ff);
        font-weight: 900;
        position: relative;
        z-index: 2;
    }

    .footer-brand strong {
        display: block;
        color: var(--ink, #fff);
        font-size: 19px;
        font-weight: 900;
        letter-spacing: .04em;
        text-transform: uppercase;
    }

    .footer-brand small {
        display: block;
        margin-top: 5px;
        color: var(--muted, rgba(255,255,255,.68));
        font-size: 11px;
        font-weight: 900;
        letter-spacing: .12em;
        text-transform: uppercase;
    }

    .footer-brand-col p {
        max-width: 450px;
        margin: 0;
        color: var(--muted, rgba(255,255,255,.68));
        line-height: 1.8;
    }

    .footer-contact-pills {
        display: grid;
        gap: 10px;
        margin-top: 20px;
    }

    .footer-contact-pills a {
        display: block;
        padding: 13px 14px;
        border-radius: 16px;
        color: var(--ink, #fff);
        text-decoration: none;
        background: rgba(255,255,255,.065);
        border: 1px solid rgba(255,255,255,.09);
        font-weight: 800;
        transition: .25s ease;
        word-break: break-word;
    }

    .footer-contact-pills a:hover {
        transform: translateY(-2px);
        border-color: rgba(35,211,255,.30);
        background: rgba(35,211,255,.09);
    }

    .footer-contact-pills span {
        display: block;
        margin-bottom: 4px;
        color: var(--mint, #6ef3cb);
        font-size: 11px;
        font-weight: 900;
        letter-spacing: .12em;
        text-transform: uppercase;
    }

    .footer-link-col h3,
    .footer-info-col h3 {
        margin: 0 0 18px;
        color: var(--ink, #fff);
        font-size: 16px;
        font-weight: 900;
        letter-spacing: .08em;
        text-transform: uppercase;
    }

    .site-footer-links {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        flex-wrap: wrap;
        gap: 12px;
    }

    .footer-link-stack {
        display: grid;
        justify-content: stretch;
        gap: 10px;
    }

    .site-footer-links a {
        color: var(--muted, rgba(255, 255, 255, .68));
        font-size: 13px;
        font-weight: 800;
        text-decoration: none;
        padding: 10px 12px;
        border-radius: 999px;
        background: rgba(255, 255, 255, .055);
        border: 1px solid rgba(255, 255, 255, .08);
        transition: .25s ease;
    }

    .footer-link-stack a {
        border-radius: 14px;
    }

    .site-footer-links a:hover {
        color: var(--ink, #fff);
        border-color: rgba(35, 211, 255, .34);
        background: rgba(35, 211, 255, .10);
        transform: translateY(-2px);
    }

    .footer-info-list {
        display: grid;
        gap: 12px;
    }

    .footer-info-list div {
        padding: 14px;
        border-radius: 16px;
        background: rgba(255,255,255,.065);
        border: 1px solid rgba(255,255,255,.09);
    }

    .footer-info-list span {
        display: block;
        margin-bottom: 5px;
        color: var(--mint, #6ef3cb);
        font-size: 11px;
        font-weight: 900;
        letter-spacing: .12em;
        text-transform: uppercase;
    }

    .footer-info-list strong {
        display: block;
        color: var(--ink, #fff);
        line-height: 1.55;
        font-size: 14px;
    }

    .footer-socials {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 18px;
    }

    .footer-socials a {
        padding: 9px 12px;
        border-radius: 999px;
        color: var(--ink, #fff);
        text-decoration: none;
        background: rgba(255,255,255,.07);
        border: 1px solid rgba(255,255,255,.10);
        font-size: 12px;
        font-weight: 900;
        transition: .25s ease;
    }

    .footer-socials a:hover {
        color: #06111a;
        background: linear-gradient(135deg, var(--cyan, #23d3ff), var(--mint, #6ef3cb));
        border-color: transparent;
        transform: translateY(-2px);
    }

    .footer-bottom {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 18px;
        flex-wrap: wrap;
        margin-top: 24px;
        padding: 20px 4px 0;
        border-top: 1px solid rgba(255,255,255,.10);
    }

    .footer-bottom p {
        margin: 0;
        color: var(--muted, rgba(255,255,255,.68));
        font-size: 13px;
        font-weight: 700;
    }

    .footer-bottom nav {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    .footer-bottom nav a {
        color: var(--muted, rgba(255,255,255,.68));
        text-decoration: none;
        font-size: 13px;
        font-weight: 800;
        transition: .25s ease;
    }

    .footer-bottom nav a:hover {
        color: var(--mint, #6ef3cb);
    }

    .mobile-bottom-nav {
        display: none;
    }

    @media (max-width: 1100px) {
        .premium-footer-inner {
            grid-template-columns: 1fr 1fr;
        }

        .footer-cta {
            grid-template-columns: 1fr;
        }

        .footer-cta-actions {
            justify-content: flex-start;
        }
    }

    @media (max-width: 768px) {
        body {
            padding-bottom: calc(96px + env(safe-area-inset-bottom)) !important;
        }

        .site-footer {
            padding: 58px 0 128px;
        }

        .footer-cta {
            padding: 24px;
            border-radius: 24px;
        }

        .footer-cta h2 {
            font-size: 30px;
        }

        .footer-cta-actions {
            align-items: stretch;
            flex-direction: column;
        }

        .footer-btn {
            width: 100%;
        }

        .premium-footer-inner {
            grid-template-columns: 1fr;
            padding: 24px;
            border-radius: 24px;
        }

        .site-footer-inner {
            flex-direction: column;
            align-items: flex-start;
        }

        .site-footer-links {
            justify-content: flex-start;
        }

        .footer-bottom {
            align-items: flex-start;
            flex-direction: column;
        }

        /* MOBILE INSTAGRAM STYLE BOTTOM NAV - SAME AS BEFORE */
        .mobile-bottom-nav {
            position: fixed !important;
            left: 10px !important;
            right: 10px !important;
            top: auto !important;
            bottom: calc(10px + env(safe-area-inset-bottom)) !important;
            z-index: 9999 !important;
            height: 74px;
            display: grid !important;
            grid-template-columns: repeat(5, minmax(0, 1fr));
            align-items: center;
            gap: 4px;
            padding: 8px;
            border-radius: 28px;
            border: 1px solid rgba(255, 255, 255, .15);
            background:
                radial-gradient(circle at 50% 0, rgba(35, 211, 255, .20), transparent 15rem),
                linear-gradient(180deg, rgba(18, 22, 52, .94), rgba(7, 9, 25, .96));
            box-shadow:
                0 -18px 70px rgba(0, 0, 0, .45),
                inset 0 1px 0 rgba(255, 255, 255, .08);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
        }

        .mobile-bottom-nav::before {
            content: "";
            position: absolute;
            inset: 7px;
            border-radius: 22px;
            border: 1px solid rgba(255, 255, 255, .06);
            pointer-events: none;
        }

        .mobile-bottom-link {
            min-width: 0;
            min-height: 56px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 4px;
            padding: 0 3px;
            border-radius: 20px;
            color: rgba(247, 251, 255, .76);
            font-size: 10px;
            font-weight: 900;
            text-decoration: none;
            white-space: nowrap;
            position: relative;
            z-index: 2;
            transition: .22s ease;
        }

        .mobile-bottom-icon {
            width: 31px;
            height: 31px;
            display: grid;
            place-items: center;
            border-radius: 12px;
            color: var(--mint, #6ef3cb);
            background: rgba(255, 255, 255, .075);
            border: 1px solid rgba(255, 255, 255, .12);
            transition: .22s ease;
        }

        .mobile-bottom-icon svg {
            width: 17px;
            height: 17px;
            fill: currentColor;
        }

        .mobile-bottom-link.active,
        .mobile-bottom-link:hover {
            color: var(--ink, #fff);
        }

        .mobile-bottom-link.active .mobile-bottom-icon,
        .mobile-bottom-link:hover .mobile-bottom-icon {
            transform: translateY(-2px);
            color: var(--ink, #fff);
            background: linear-gradient(135deg, rgba(35, 211, 255, .25), rgba(110, 243, 203, .14));
            box-shadow: 0 10px 26px rgba(35, 211, 255, .18);
        }

        .mobile-bottom-link.is-center {
            transform: translateY(-20px);
        }

        .mobile-bottom-link.is-center .mobile-bottom-icon {
            width: 56px;
            height: 56px;
            border: 0;
            border-radius: 22px;
            color: #06111a;
            background:
                radial-gradient(circle at 30% 20%, rgba(255, 255, 255, .82), transparent 23px),
                linear-gradient(135deg, var(--cyan, #23d3ff), var(--mint, #6ef3cb));
            box-shadow:
                0 16px 40px rgba(35, 211, 255, .36),
                0 0 0 7px rgba(35, 211, 255, .08);
        }

        .mobile-bottom-link.is-center .mobile-bottom-icon svg {
            width: 25px;
            height: 25px;
        }

        .mobile-bottom-link.is-center span:last-child {
            color: var(--ink, #fff);
            text-shadow: 0 8px 24px rgba(35, 211, 255, .26);
        }
    }

    @media (max-width: 420px) {
        .footer-cta,
        .premium-footer-inner {
            padding: 20px;
        }

        .footer-brand {
            align-items: flex-start;
        }

        .footer-logo {
            width: 56px;
            height: 56px;
            border-radius: 18px;
        }

        .footer-logo img,
        .footer-logo strong {
            width: 48px;
            height: 48px;
        }

        .footer-brand strong {
            font-size: 16px;
        }

        .mobile-bottom-nav {
            left: 8px !important;
            right: 8px !important;
            height: 72px;
            border-radius: 24px;
        }

        .mobile-bottom-link {
            font-size: 9px;
        }

        .mobile-bottom-icon {
            width: 29px;
            height: 29px;
            border-radius: 11px;
        }

        .mobile-bottom-link.is-center .mobile-bottom-icon {
            width: 52px;
            height: 52px;
            border-radius: 20px;
        }
    }
</style>