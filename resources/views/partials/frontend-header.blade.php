@php($siteSettings = $siteSettings ?? \App\Models\SiteSetting::current())

<header class="site-header">
    <div class="wrap site-header-inner">
        <a class="site-brand" href="{{ route('landing') }}">
            @if($siteSettings->logo_url)
                <img src="{{ $siteSettings->logo_url }}" alt="{{ $siteSettings->site_name }}">
            @else
                <span>RT</span>
            @endif
           
        </a>

        <button class="site-menu-toggle" type="button" aria-label="Open menu" aria-expanded="false" data-menu-toggle>
            <i></i><i></i><i></i>
        </button>

        <nav class="site-nav" data-site-menu>
            <div class="site-mobile-menu-head">
                <span class="eyebrow">Menu</span>
                <strong>{{ $siteSettings->site_name }}</strong>
            </div>
            <a class="site-nav-link mobile-tab" href="{{ route('landing') }}"><span class="site-nav-icon">H</span><span>Home</span></a>
            <a class="site-nav-link desktop-only" href="{{ route('about') }}">About</a>
            <a class="site-nav-link mobile-tab" href="{{ route('courses.index') }}"><span class="site-nav-icon">C</span><span>Courses</span></a>
            <a class="site-nav-link mobile-tab is-center" href="{{ route('enquiry.create') }}"><span class="site-nav-icon">+</span><span>Enquiry</span></a>
            <a class="site-nav-link desktop-only" href="{{ route('contact') }}">Contact</a>
            <a class="site-nav-link mobile-tab" href="{{ route('certificates.verify') }}"><span class="site-nav-icon">V</span><span>Verify</span></a>
            @auth
                <a class="site-nav-link mobile-tab" href="{{ route(auth()->user()->is_admin ? 'admin.home' : 'student.dashboard') }}"><span class="site-nav-icon">D</span><span>Panel</span></a>
                @unless(auth()->user()->is_admin)
                    <a class="site-nav-link desktop-only" href="{{ route('student.profile.show') }}">Profile</a>
                @endunless
            @else
                <a class="site-nav-link mobile-tab" href="{{ route('login') }}"><span class="site-nav-icon">U</span><span>Login</span></a>
                <a class="site-nav-link desktop-only" href="{{ route('register') }}">Register</a>
            @endauth
            <div class="site-mobile-menu-actions">
                <a class="btn primary" href="{{ route('courses.index') }}">Explore Courses</a>
                <a class="btn" href="{{ route('enquiry.create') }}">Send Enquiry</a>
            </div>
        </nav>

        <a class="btn primary site-header-cta" href="{{ route('courses.index') }}">Explore</a>
    </div>
</header>
<div class="site-menu-backdrop" data-menu-backdrop></div>
