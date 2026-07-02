<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @php($siteSettings = \App\Models\SiteSetting::current())
    @php($pageTitle = trim($__env->yieldContent('title', $siteSettings->meta_title ?: $siteSettings->site_name)))
    @php($pageDescription = trim($__env->yieldContent('meta_description', $siteSettings->meta_description ?: 'R Tech Computer online courses, student dashboard and uploaded certificate verification.')))
    @php($pageKeywords = trim($__env->yieldContent('meta_keywords', $siteSettings->meta_keywords ?: 'computer courses, online learning, certificate, R Tech Computer')))
    @php($pageImage = trim($__env->yieldContent('meta_image', $siteSettings->logo_url ?: asset('favicon.ico'))))
    <title>{{ $pageTitle }}</title>
    <meta name="description" content="{{ $pageDescription }}">
    <meta name="keywords" content="{{ $pageKeywords }}">
    <meta property="og:title" content="{{ $pageTitle }}">
    <meta property="og:description" content="{{ $pageDescription }}">
    <meta property="og:image" content="{{ $pageImage }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="twitter:card" content="summary_large_image">
    @if($siteSettings->favicon_url)
        <link rel="icon" href="{{ $siteSettings->favicon_url }}">
    @else
        <link rel="icon" href="{{ asset('favicon.ico') }}">
    @endif
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700|jetbrains-mono:400,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/frontend.css') }}?v=20260702g">
</head>
<body class="frontend-page">
    @include('partials.page-loader')
    @include('partials.frontend-header')
    <main>@yield('content')</main>
    @include('partials.frontend-footer')
    @yield('scripts')
    <script src="{{ asset('js/frontend.js') }}?v=20260702g" defer></script>
</body>
</html>
