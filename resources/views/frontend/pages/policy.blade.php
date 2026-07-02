@extends('layouts.frontend')

@section('title', $title . ' | R Tech Computer')
@section('meta_description', $intro)
@section('meta_keywords', strtolower($title) . ', R Tech Computer policy')

@section('content')
<section class="page">
    <div class="wrap">
        <div class="hero-small" style="padding-top:20px">
            <div class="eyebrow">Policy</div>
            <h1>{{ $title }}</h1>
            <p class="muted">{{ $intro }}</p>
        </div>
        <div class="card">
            @foreach(preg_split('/\r\n|\r|\n/', $body ?: '') as $item)
                @continue(trim($item) === '')
                <div style="padding:18px 0;border-bottom:1px solid var(--line)">
                    <span class="pill">0{{ $loop->iteration }}</span>
                    <p class="muted" style="margin:0">{{ $item }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
