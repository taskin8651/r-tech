@extends('layouts.frontend')

@section('title', 'Certificate ' . $certificate->certificate_id)

@section('content')
<section class="page">
    <div class="wrap">
        <div class="certificate-sheet">
            <div class="eyebrow" style="color:#0891b2">R Tech Computer</div>
            <h1>Uploaded Certificate</h1>
            <p>Certificate uploaded for</p>
            <h2 style="font-size:46px">{{ $certificate->user->name }}</h2>
            <div class="line"></div>
            <p>for successfully completing</p>
            <h2>{{ $certificate->course->title }}</h2>
            <p>Issued on {{ $certificate->issued_at->format('d M Y') }}</p>
            <p><strong>Certificate ID:</strong> {{ $certificate->certificate_id }}</p>
            @if($certificate->file_url)
                <p><a href="{{ $certificate->file_url }}" target="_blank">Open uploaded certificate file</a></p>
            @else
                <p>Certificate file is pending upload by admin.</p>
            @endif
            <p>Verify: {{ route('certificates.verify', ['certificate_id' => $certificate->certificate_id]) }}</p>
        </div>
        <div class="no-print" style="margin-top:18px;display:flex;gap:12px">
            @if($certificate->file_url)
                <a class="btn primary" href="{{ $certificate->file_url }}" target="_blank">Download Uploaded File</a>
            @else
                <button class="btn primary" disabled>Certificate Pending</button>
            @endif
            <a class="btn" href="{{ route('certificates.verify', ['certificate_id' => $certificate->certificate_id]) }}">Public Verify</a>
        </div>
    </div>
</section>
@endsection
