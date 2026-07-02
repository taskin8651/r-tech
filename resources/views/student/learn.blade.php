@extends('layouts.frontend')

@section('title', 'Learn ' . $enrollment->course->title . ' | R Tech Computer')

@section('content')
<section class="page">
    <div class="wrap">
        @if(session('message'))<div class="alert">{{ session('message') }}</div>@endif
        <div class="hero-small" style="padding-top:20px">
            <div class="eyebrow">Learning Page</div>
            <h1>{{ $enrollment->course->title }}</h1>
            <div class="progress" style="max-width:520px"><i style="width:{{ $enrollment->progress }}%"></i></div>
            <p class="muted">{{ $enrollment->progress }}% completed</p>
        </div>

        <div class="grid grid-2">
            <div>
                @forelse($enrollment->course->modules as $module)
                    <div class="card" style="margin-bottom:16px">
                        <span class="pill">Module {{ $loop->iteration }}</span>
                        <h2 style="font-size:28px">{{ $module->title }}</h2>
                        <p class="muted">{{ $module->description }}</p>
                        @foreach($module->lessons as $lesson)
                            <div style="padding:14px 0;border-top:1px solid var(--line)">
                                <strong>{{ $lesson->title }}</strong>
                                <p class="muted">{{ $lesson->description }}</p>
                                <div style="display:flex;gap:10px;flex-wrap:wrap">
                                    @if($lesson->video_url)<a class="btn" target="_blank" href="{{ $lesson->video_url }}">Video</a>@endif
                                    @if($lesson->notes_url)<a class="btn" target="_blank" href="{{ $lesson->notes_url }}">Notes</a>@endif
                                    @if($lesson->practice_file_url)<a class="btn" target="_blank" href="{{ $lesson->practice_file_url }}">Practice File</a>@endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @empty
                    <div class="card">Lessons will be available soon.</div>
                @endforelse
            </div>
            <aside class="card" style="height:max-content;position:sticky;top:96px">
                <span class="pill">Course Actions</span>
                <h2>Finish and certify</h2>
                <p class="muted">Mark complete when the student has finished all course requirements.</p>
                <form method="POST" action="{{ route('student.learn.complete', $enrollment) }}">
                    @csrf
                    <button class="btn primary" style="width:100%;margin-top:12px" type="submit">Mark Course Complete</button>
                </form>
                @if($enrollment->certificate)
                    <a class="btn" style="width:100%;margin-top:10px" href="{{ route('student.certificates.show', $enrollment->certificate) }}">Download Certificate</a>
                @endif
            </aside>
        </div>
    </div>
</section>
@endsection
