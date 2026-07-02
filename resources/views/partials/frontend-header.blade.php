@php
    $siteSettings = $siteSettings ?? \App\Models\SiteSetting::current();

    $phoneRaw = $siteSettings->phone
        ?? $siteSettings->mobile
        ?? $siteSettings->contact_number
        ?? '+919999999999';

    $whatsappRaw = $siteSettings->whatsapp_number
        ?? $siteSettings->whatsapp
        ?? $phoneRaw;

    $phoneHref = preg_replace('/\s+/', '', $phoneRaw);

    $waDigits = preg_replace('/\D+/', '', $whatsappRaw);
    if (strlen($waDigits) === 10) {
        $waDigits = '91' . $waDigits;
    }

    $whatsappMessage = urlencode('Hello, I want to enquire about R Tech Computer courses.');
@endphp

<header class="site-header">
    <div class="wrap site-header-inner">

        {{-- BRAND --}}
        <a class="site-brand" href="{{ route('landing') }}" aria-label="{{ $siteSettings->site_name ?? 'R Tech Computer' }}">
            <span class="site-brand-mark">
                @if($siteSettings->logo_url)
                    <img src="{{ $siteSettings->logo_url }}" alt="{{ $siteSettings->site_name }}">
                @else
                    <span class="site-brand-fallback">RT</span>
                @endif
            </span>
        </a>

        {{-- MOBILE RIGHT ACTIONS --}}
        <div class="mobile-header-actions">
            <a href="tel:{{ $phoneHref }}" class="mobile-header-action call" aria-label="Call now">
                <svg viewBox="0 0 24 24">
                    <path d="M6.6 10.8c1.4 2.8 3.8 5.2 6.6 6.6l2.2-2.2c.3-.3.8-.4 1.2-.3 1.3.4 2.6.6 4 .6.7 0 1.2.5 1.2 1.2v3.5c0 .7-.5 1.2-1.2 1.2C10.4 22 2 13.6 2 3.4 2 2.7 2.5 2.2 3.2 2.2h3.5c.7 0 1.2.5 1.2 1.2 0 1.4.2 2.7.6 4 .1.4 0 .9-.3 1.2l-1.6 2.2Z"/>
                </svg>
            </a>

            <a href="https://wa.me/{{ $waDigits }}?text={{ $whatsappMessage }}" target="_blank" rel="noopener" class="mobile-header-action whatsapp" aria-label="WhatsApp enquiry">
                <svg viewBox="0 0 24 24">
                    <path d="M20.5 3.5A11.8 11.8 0 0 0 12.1 0C5.7 0 .5 5.2.5 11.6c0 2 .5 4 1.6 5.8L.4 24l6.8-1.8c1.7.9 3.6 1.4 5.5 1.4h.1c6.4 0 11.6-5.2 11.6-11.6 0-3.1-1.2-6-3.4-8.2Zm-8.4 18c-1.7 0-3.3-.4-4.7-1.3l-.3-.2-4 1.1 1.1-3.9-.3-.4c-.9-1.5-1.4-3.2-1.4-5 0-5.3 4.3-9.6 9.6-9.6 2.6 0 5 1 6.8 2.8 1.8 1.8 2.8 4.2 2.8 6.8 0 5.4-4.3 9.7-9.6 9.7Zm5.3-7.2c-.3-.1-1.7-.8-2-.9-.3-.1-.5-.1-.7.1-.2.3-.8.9-1 1.1-.2.2-.4.2-.7.1-.3-.1-1.2-.4-2.3-1.4-.8-.7-1.4-1.6-1.6-1.9-.2-.3 0-.5.1-.6.1-.1.3-.3.4-.5.1-.2.2-.3.3-.5.1-.2 0-.4 0-.5-.1-.1-.7-1.6-.9-2.2-.2-.6-.5-.5-.7-.5h-.6c-.2 0-.5.1-.8.4-.3.3-1 1-1 2.4s1 2.8 1.2 3c.1.2 2 3.1 4.9 4.3.7.3 1.2.5 1.6.6.7.2 1.3.2 1.8.1.6-.1 1.7-.7 1.9-1.3.2-.7.2-1.2.2-1.3-.1-.1-.3-.2-.6-.4Z"/>
                </svg>
            </a>
        </div>

        {{-- TABLET MENU TOGGLE --}}
        <button class="site-menu-toggle" type="button" aria-label="Open menu" aria-expanded="false" data-menu-toggle>
            <i></i>
            <i></i>
            <i></i>
        </button>

        {{-- DESKTOP / TABLET NAV --}}
        <nav class="site-nav" data-site-menu>
            <div class="site-mobile-menu-head">
                <span class="eyebrow">Premium Menu</span>
                <strong>{{ $siteSettings->site_name ?? 'R Tech Computer' }}</strong>
                <p>Explore courses, verify certificates and access your panel.</p>
            </div>

            <a class="site-nav-link {{ request()->routeIs('landing') ? 'active' : '' }}" href="{{ route('landing') }}">Home</a>
            <a class="site-nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a>
            <a class="site-nav-link {{ request()->routeIs('courses.*') ? 'active' : '' }}" href="{{ route('courses.index') }}">Courses</a>
            <a class="site-nav-link {{ request()->routeIs('enquiry.*') ? 'active' : '' }}" href="{{ route('enquiry.create') }}">Enquiry</a>
            <a class="site-nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a>
            <a class="site-nav-link {{ request()->routeIs('certificates.*') ? 'active' : '' }}" href="{{ route('certificates.verify') }}">Verify</a>

            @auth
                <a class="site-nav-link {{ request()->routeIs('admin.home') || request()->routeIs('student.dashboard') ? 'active' : '' }}"
                   href="{{ route(auth()->user()->is_admin ? 'admin.home' : 'student.dashboard') }}">
                    Panel
                </a>

                @unless(auth()->user()->is_admin)
                    <a class="site-nav-link {{ request()->routeIs('student.profile.*') ? 'active' : '' }}"
                       href="{{ route('student.profile.show') }}">
                        Profile
                    </a>
                @endunless
            @else
                <a class="site-nav-link {{ request()->routeIs('login') ? 'active' : '' }}" href="{{ route('login') }}">Login</a>
                <a class="site-nav-link {{ request()->routeIs('register') ? 'active' : '' }}" href="{{ route('register') }}">Register</a>
            @endauth

            <div class="site-mobile-menu-actions">
                <a class="site-mini-btn primary" href="{{ route('courses.index') }}">Explore Courses</a>
                <a class="site-mini-btn" href="{{ route('enquiry.create') }}">Send Enquiry</a>
            </div>
        </nav>

        <a class="site-header-cta" href="{{ route('courses.index') }}">
            Explore
            <span>→</span>
        </a>
    </div>
</header>

<div class="site-menu-backdrop" data-menu-backdrop></div>

<style>
    :root {
        --rt-ink: var(--ink, #f7fbff);
        --rt-muted: var(--muted, rgba(238, 244, 255, .68));
        --rt-cyan: var(--cyan, #23d3ff);
        --rt-mint: var(--mint, #6ef3cb);
        --rt-dark: #070919;
        --rt-border: rgba(255, 255, 255, .14);
        --rt-shadow: 0 24px 80px rgba(0, 0, 0, .35);
    }

    .site-header {
        position: sticky;
        top: 0;
        z-index: 80;
        background:
            radial-gradient(circle at 20% 0%, rgba(35, 211, 255, .13), transparent 30rem),
            radial-gradient(circle at 80% 0%, rgba(110, 243, 203, .10), transparent 26rem),
            rgba(6, 8, 24, .82);
        border-bottom: 1px solid var(--rt-border);
        backdrop-filter: blur(22px);
        -webkit-backdrop-filter: blur(22px);
    }

    .landing-page .site-header {
        position: fixed;
        inset: 0 0 auto;
        border-radius: 0;
    }

    .site-header::before {
        content: "";
        position: absolute;
        inset: auto 0 0;
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(35, 211, 255, .72), rgba(110, 243, 203, .6), transparent);
        opacity: .75;
        pointer-events: none;
    }

    .site-header-inner {
        min-height: 76px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 18px;
        position: relative;
    }

    .landing-page .site-header-inner {
        min-height: 70px;
    }

    .site-brand {
        display: inline-flex;
        align-items: center;
        gap: 13px;
        min-width: 0;
        color: var(--rt-ink);
        text-decoration: none;
    }

    .site-brand-mark {
        width: 50px;
        height: 50px;
        display: grid;
        place-items: center;
        border-radius: 17px;
        position: relative;
        overflow: hidden;
        flex: 0 0 auto;
        background:
            linear-gradient(145deg, rgba(255, 255, 255, .14), rgba(255, 255, 255, .055)),
            rgba(255, 255, 255, .08);
        border: 1px solid rgba(255, 255, 255, .18);
        box-shadow:
            0 14px 40px rgba(0, 0, 0, .22),
            inset 0 1px 0 rgba(255, 255, 255, .18);
    }

    .site-brand-mark::after {
        content: "";
        position: absolute;
        inset: -40%;
        background: linear-gradient(120deg, transparent 35%, rgba(35, 211, 255, .30), transparent 65%);
        transform: translateX(-85%) rotate(18deg);
        animation: rtLogoShine 4.8s ease-in-out infinite;
    }

    @keyframes rtLogoShine {
        0%, 62%, 100% {
            transform: translateX(-85%) rotate(18deg);
        }

        75% {
            transform: translateX(85%) rotate(18deg);
        }
    }

    .site-brand-mark img,
    .site-brand-fallback {
        width: 42px;
        height: 42px;
        display: grid;
        place-items: center;
        border-radius: 13px;
        object-fit: contain;
        color: var(--rt-cyan);
        font: 900 13px "JetBrains Mono", monospace;
        position: relative;
        z-index: 2;
    }

    .site-nav {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        color: var(--rt-muted);
        font-size: 14px;
    }

    .site-nav-link {
        min-height: 42px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 10px 13px;
        border-radius: 999px;
        color: var(--rt-muted);
        text-decoration: none;
        font-weight: 800;
        letter-spacing: .01em;
        position: relative;
        transition: color .24s ease, transform .24s ease;
    }

    .site-nav-link::before {
        content: "";
        position: absolute;
        inset: 0;
        border-radius: inherit;
        background: linear-gradient(135deg, rgba(35, 211, 255, .16), rgba(110, 243, 203, .10));
        opacity: 0;
        transition: opacity .24s ease;
    }

    .site-nav-link:hover,
    .site-nav-link.active {
        color: var(--rt-ink);
        transform: translateY(-1px);
    }

    .site-nav-link:hover::before,
    .site-nav-link.active::before {
        opacity: 1;
    }

    .site-mobile-menu-head,
    .site-mobile-menu-actions,
    .site-menu-backdrop,
    .mobile-header-actions {
        display: none;
    }

    .site-menu-toggle {
        display: none;
        width: 46px;
        height: 46px;
        border: 1px solid rgba(255, 255, 255, .16);
        border-radius: 15px;
        background:
            linear-gradient(145deg, rgba(255, 255, 255, .12), rgba(255, 255, 255, .045)),
            rgba(255, 255, 255, .08);
        cursor: pointer;
        transition: .22s ease;
    }

    .site-menu-toggle:hover {
        transform: translateY(-2px);
        border-color: rgba(35, 211, 255, .42);
    }

    .site-menu-toggle i {
        display: block;
        width: 18px;
        height: 2px;
        margin: 4px auto;
        border-radius: 999px;
        background: var(--rt-ink);
        transition: transform .25s ease, opacity .2s ease;
    }

    .site-menu-toggle.is-open {
        background: linear-gradient(135deg, rgba(35, 211, 255, .24), rgba(110, 243, 203, .14));
        border-color: rgba(35, 211, 255, .48);
    }

    .site-menu-toggle.is-open i:nth-child(1) {
        transform: translateY(6px) rotate(45deg);
    }

    .site-menu-toggle.is-open i:nth-child(2) {
        opacity: 0;
    }

    .site-menu-toggle.is-open i:nth-child(3) {
        transform: translateY(-6px) rotate(-45deg);
    }

    .site-header-cta,
    .site-mini-btn {
        min-height: 44px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 11px 18px;
        border-radius: 999px;
        color: #06111a;
        background: linear-gradient(135deg, var(--rt-cyan), var(--rt-mint));
        font-weight: 900;
        text-decoration: none;
        border: 0;
        box-shadow: 0 12px 36px rgba(35, 211, 255, .18);
        white-space: nowrap;
    }

    .site-mini-btn:not(.primary) {
        color: var(--rt-ink);
        background: rgba(255, 255, 255, .08);
        border: 1px solid rgba(255, 255, 255, .14);
        box-shadow: none;
    }

    /* TABLET MENU */
    @media (max-width: 1120px) and (min-width: 769px) {
        .site-menu-toggle {
            display: block;
            order: 3;
        }

        .site-header-cta {
            margin-left: auto;
        }

        .site-nav {
            position: fixed;
            left: 16px;
            right: 16px;
            top: 88px;
            z-index: 90;
            display: flex;
            flex-direction: column;
            align-items: stretch;
            gap: 9px;
            max-height: min(78vh, 620px);
            overflow-y: auto;
            padding: 20px;
            border: 1px solid rgba(255, 255, 255, .16);
            border-radius: 24px;
            background:
                radial-gradient(circle at 12% 0, rgba(35, 211, 255, .20), transparent 14rem),
                radial-gradient(circle at 90% 100%, rgba(110, 243, 203, .13), transparent 13rem),
                linear-gradient(145deg, rgba(14, 18, 42, .985), rgba(7, 9, 25, .97));
            box-shadow: var(--rt-shadow);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
            transform: translateY(-16px) scale(.985);
            transition: opacity .24s ease, transform .24s ease, visibility .24s ease;
        }

        .site-nav.is-open {
            opacity: 1;
            visibility: visible;
            pointer-events: auto;
            transform: translateY(0) scale(1);
        }

        .site-nav .site-nav-link {
            min-height: 52px;
            justify-content: space-between;
            padding: 14px 15px;
            border: 1px solid rgba(255, 255, 255, .09);
            border-radius: 16px;
            background: rgba(255, 255, 255, .052);
            color: var(--rt-ink);
        }

        .site-nav .site-nav-link::after {
            content: "→";
            color: var(--rt-mint);
            font: 900 14px "JetBrains Mono", monospace;
            position: relative;
            z-index: 2;
        }

        .site-mobile-menu-head {
            display: block;
            padding: 4px 4px 14px;
            border-bottom: 1px solid rgba(255, 255, 255, .1);
            margin-bottom: 6px;
        }

        .site-mobile-menu-head strong {
            display: block;
            margin-top: 7px;
            color: var(--rt-ink);
            font-size: 20px;
            letter-spacing: .04em;
            text-transform: uppercase;
        }

        .site-mobile-menu-head p {
            margin: 7px 0 0;
            color: var(--rt-muted);
            font-size: 13px;
            line-height: 1.6;
        }

        .site-mobile-menu-actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-top: 8px;
        }

        .site-menu-backdrop {
            position: fixed;
            inset: 0;
            z-index: 70;
            display: block;
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
            background: linear-gradient(180deg, rgba(2, 4, 14, .28), rgba(2, 4, 14, .76));
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            transition: opacity .24s ease, visibility .24s ease;
        }

        .site-menu-backdrop.is-open {
            opacity: 1;
            visibility: visible;
            pointer-events: auto;
        }
    }

    /* MOBILE: LOGO LEFT + CALL/WHATSAPP RIGHT */
    @media (max-width: 768px) {
        body {
            padding-top: 66px;
        }

        .site-header,
        .landing-page .site-header {
            position: fixed !important;
            left: 0 !important;
            right: 0 !important;
            top: 0 !important;
            z-index: 90 !important;
            border-bottom: 1px solid rgba(255, 255, 255, .10);
            background:
                radial-gradient(circle at 8% -70%, rgba(35, 211, 255, .24), transparent 18rem),
                radial-gradient(circle at 95% -60%, rgba(110, 243, 203, .18), transparent 16rem),
                linear-gradient(180deg, rgba(8, 10, 28, .97), rgba(7, 9, 25, .90));
        }

        .site-header-inner,
        .landing-page .site-header-inner {
            min-height: 66px !important;
            justify-content: space-between !important;
            padding-inline: 14px;
            gap: 12px;
        }

        .site-brand {
            justify-content: flex-start !important;
            margin: 0 !important;
            flex: 0 0 auto;
        }

        .site-menu-toggle,
        .site-header-cta,
        .site-header .site-nav,
        .site-header .site-menu-backdrop,
        .site-menu-backdrop {
            display: none !important;
            opacity: 0 !important;
            visibility: hidden !important;
            pointer-events: none !important;
        }

        .site-brand-mark {
            width: 52px;
            height: 52px;
            border-radius: 18px;
            box-shadow:
                0 16px 46px rgba(0, 0, 0, .24),
                0 0 0 4px rgba(35, 211, 255, .05),
                inset 0 1px 0 rgba(255, 255, 255, .18);
        }

        .site-brand-mark img,
        .site-brand-fallback {
            width: 44px;
            height: 44px;
            border-radius: 14px;
        }

        .mobile-header-actions {
            display: flex !important;
            align-items: center;
            justify-content: flex-end;
            gap: 10px;
            margin-left: auto;
        }

        .mobile-header-action {
            width: 44px;
            height: 44px;
            display: grid;
            place-items: center;
            border-radius: 16px;
            position: relative;
            overflow: hidden;
            color: var(--rt-ink);
            text-decoration: none;
            border: 1px solid rgba(255, 255, 255, .14);
            background:
                linear-gradient(145deg, rgba(255, 255, 255, .13), rgba(255, 255, 255, .045)),
                rgba(255, 255, 255, .075);
            box-shadow:
                0 12px 34px rgba(0, 0, 0, .22),
                inset 0 1px 0 rgba(255, 255, 255, .14);
            transition: transform .22s ease, box-shadow .22s ease, border-color .22s ease;
        }

        .mobile-header-action::before {
            content: "";
            position: absolute;
            inset: -40%;
            background: linear-gradient(120deg, transparent 35%, rgba(255, 255, 255, .38), transparent 65%);
            transform: translateX(-90%) rotate(18deg);
            transition: transform .55s ease;
        }

        .mobile-header-action:hover::before {
            transform: translateX(90%) rotate(18deg);
        }

        .mobile-header-action:hover {
            transform: translateY(-2px);
            box-shadow:
                0 16px 42px rgba(0, 0, 0, .30),
                0 0 0 4px rgba(35, 211, 255, .06);
        }

        .mobile-header-action svg {
            width: 20px;
            height: 20px;
            fill: currentColor;
            position: relative;
            z-index: 2;
        }

        .mobile-header-action.call {
            color: #06111a;
            background:
                radial-gradient(circle at 30% 20%, rgba(255, 255, 255, .82), transparent 20px),
                linear-gradient(135deg, var(--rt-cyan), var(--rt-mint));
            border-color: rgba(35, 211, 255, .35);
            box-shadow:
                0 14px 36px rgba(35, 211, 255, .25),
                0 0 0 4px rgba(35, 211, 255, .06);
        }

        .mobile-header-action.whatsapp {
            color: #ffffff;
            background:
                radial-gradient(circle at 30% 20%, rgba(255, 255, 255, .32), transparent 20px),
                linear-gradient(135deg, #25d366, #128c7e);
            border-color: rgba(37, 211, 102, .38);
            box-shadow:
                0 14px 36px rgba(37, 211, 102, .22),
                0 0 0 4px rgba(37, 211, 102, .06);
        }
    }

    @media (max-width: 390px) {
        .site-header-inner,
        .landing-page .site-header-inner {
            padding-inline: 10px;
        }

        .site-brand-mark {
            width: 48px;
            height: 48px;
        }

        .site-brand-mark img,
        .site-brand-fallback {
            width: 40px;
            height: 40px;
        }

        .mobile-header-action {
            width: 41px;
            height: 41px;
            border-radius: 15px;
        }

        .mobile-header-action svg {
            width: 18px;
            height: 18px;
        }
    }
</style>

<script>
    (function () {
        const toggle = document.querySelector('[data-menu-toggle]');
        const menu = document.querySelector('[data-site-menu]');
        const backdrop = document.querySelector('[data-menu-backdrop]');

        if (!toggle || !menu) return;

        function setMenu(open) {
            menu.classList.toggle('is-open', open);
            toggle.classList.toggle('is-open', open);
            backdrop?.classList.toggle('is-open', open);
            toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
            document.body.classList.toggle('menu-open', open);
        }

        toggle.addEventListener('click', function () {
            setMenu(!menu.classList.contains('is-open'));
        });

        menu.querySelectorAll('a').forEach(function (link) {
            link.addEventListener('click', function () {
                setMenu(false);
            });
        });

        backdrop?.addEventListener('click', function () {
            setMenu(false);
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') setMenu(false);
        });
    })();
</script>