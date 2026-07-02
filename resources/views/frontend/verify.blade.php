@extends('layouts.frontend')

@section('title', 'Verify Certificate | R Tech Computer')

@section('content')
<section class="page">
    <div class="wrap">
        <div class="hero-small" style="padding-top:20px">
            <div class="eyebrow">Certificate Verification</div>
            <h1>Verify a completion certificate.</h1>
        </div>
        <form class="card" method="GET" style="margin-bottom:22px">
            <div class="grid grid-2">
                <input name="certificate_id" value="{{ request('certificate_id') }}" placeholder="Enter certificate ID, e.g. RTC-2026-XXXXXXXX">
                <button class="btn primary" type="submit">Verify</button>
            </div>
        </form>

        @if(request()->filled('certificate_id'))
            <div class="card">
                @if($certificate && ! $certificate->is_revoked)
                    <span class="pill">Valid Certificate</span>
                    <h2>{{ $certificate->user->name }}</h2>
                    <p class="muted">Successfully completed <strong>{{ $certificate->course->title }}</strong>.</p>
                    <p class="muted">Certificate ID: {{ $certificate->certificate_id }} / Issued: {{ $certificate->issued_at->format('d M Y') }}</p>
                    @if($certificate->file_url)
                        <a class="btn primary" href="{{ $certificate->file_url }}" target="_blank">View Uploaded Certificate</a>
                    @else
                        <p class="muted">Certificate record is valid, but file upload is pending.</p>
                    @endif
                @else
                    <span class="pill">Not Found</span>
                    <h2>Certificate could not be verified.</h2>
                    <p class="muted">Please check the certificate ID or contact R Tech Computer.</p>
                @endif
            </div>
        @endif
    </div>
</section>
@endsection
