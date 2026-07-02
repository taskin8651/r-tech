@php($siteSettings = $siteSettings ?? \App\Models\SiteSetting::current())

<footer class="site-footer">
    <div class="wrap site-footer-inner">
        <div>
            <strong>{{ $siteSettings->site_name }}</strong>
            <span>Practical computer courses, skill training and certificate support</span>
        </div>

        <nav class="site-footer-links">
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

            <a href="{{ route('privacy') }}">Privacy</a>
            <a href="{{ route('terms') }}">Terms</a>
            <a href="{{ route('refund') }}">Refund</a>
        </nav>
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
        padding: 34px 0;
        background:
            radial-gradient(circle at 10% 0, rgba(35, 211, 255, .10), transparent 22rem),
            radial-gradient(circle at 90% 100%, rgba(110, 243, 203, .10), transparent 20rem),
            linear-gradient(180deg, rgba(9, 12, 32, .98), rgba(5, 7, 20, 1));
        border-top: 1px solid rgba(255, 255, 255, .11);
        color: var(--ink, #fff);
    }

    .site-footer-inner {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 24px;
    }

    .site-footer-inner strong {
        display: block;
        color: var(--ink, #fff);
        font-size: 18px;
        font-weight: 900;
        letter-spacing: .04em;
        text-transform: uppercase;
    }

    .site-footer-inner span {
        display: block;
        margin-top: 7px;
        color: var(--muted, rgba(255, 255, 255, .68));
        font-size: 14px;
        line-height: 1.6;
    }

    .site-footer-links {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        flex-wrap: wrap;
        gap: 12px;
    }

    .site-footer-links a {
        color: var(--muted, rgba(255, 255, 255, .68));
        font-size: 13px;
        font-weight: 800;
        text-decoration: none;
        padding: 9px 12px;
        border-radius: 999px;
        background: rgba(255, 255, 255, .055);
        border: 1px solid rgba(255, 255, 255, .08);
        transition: .25s ease;
    }

    .site-footer-links a:hover {
        color: var(--ink, #fff);
        border-color: rgba(35, 211, 255, .34);
        background: rgba(35, 211, 255, .10);
        transform: translateY(-2px);
    }

    .mobile-bottom-nav {
        display: none;
    }

    @media (max-width: 768px) {
        body {
            padding-bottom: calc(96px + env(safe-area-inset-bottom)) !important;
        }

        .site-footer {
            padding-bottom: 128px;
        }

        .site-footer-inner {
            flex-direction: column;
            align-items: flex-start;
        }

        .site-footer-links {
            justify-content: flex-start;
        }

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