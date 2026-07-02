@php($siteSettings = $siteSettings ?? \App\Models\SiteSetting::current())

<footer class="site-footer">
    <div class="wrap site-footer-inner">
        <div>
            <strong>{{ $siteSettings->site_name }}</strong>
            <span>Practical computer courses, skill training and certificate support</span>
        </div>
        <nav class="site-footer-links">
            @if($siteSettings->facebook_url)<a href="{{ $siteSettings->facebook_url }}" target="_blank" rel="noopener">Facebook</a>@endif
            @if($siteSettings->instagram_url)<a href="{{ $siteSettings->instagram_url }}" target="_blank" rel="noopener">Instagram</a>@endif
            @if($siteSettings->youtube_url)<a href="{{ $siteSettings->youtube_url }}" target="_blank" rel="noopener">YouTube</a>@endif
            @if($siteSettings->linkedin_url)<a href="{{ $siteSettings->linkedin_url }}" target="_blank" rel="noopener">LinkedIn</a>@endif
            <a href="{{ route('privacy') }}">Privacy</a>
            <a href="{{ route('terms') }}">Terms</a>
            <a href="{{ route('refund') }}">Refund</a>
        </nav>
    </div>
</footer>
