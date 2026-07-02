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
            <a href="{{ route('landing') }}">Home</a>
            <a href="{{ route('about') }}">About</a>
            <a href="{{ route('courses.index') }}">Courses</a>
            <a href="{{ route('enquiry.create') }}">Enquiry</a>
            <a href="{{ route('contact') }}">Contact</a>
            <a href="{{ route('certificates.verify') }}">Verify Certificate</a>
            @auth
                <a href="{{ route(auth()->user()->is_admin ? 'admin.home' : 'student.dashboard') }}">Dashboard</a>
                @unless(auth()->user()->is_admin)
                    <a href="{{ route('student.profile.show') }}">Profile</a>
                @endunless
            @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
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
