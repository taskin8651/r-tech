@extends('layouts.frontend')

@section('title', 'Login | R Tech Computer')
@section('meta_description', 'Login to R Tech Computer student or admin dashboard to access courses, profile, certificates and course management.')
@section('meta_keywords', 'R Tech Computer login, student login, admin login, online course login')

@section('content')
<section class="auth-page">
    <div class="wrap auth-shell">
        <div class="auth-copy">
            <div>
                <span class="eyebrow">Secure Access</span>
                <h1>Continue your computer learning journey.</h1>
                <p class="muted">Login to open your student dashboard, continue enrolled courses, manage profile details and view uploaded certificates.</p>
            </div>
            <div class="auth-stat-grid">
                <div class="auth-stat"><strong>Admin</strong><span class="muted">Course control</span></div>
                <div class="auth-stat"><strong>Student</strong><span class="muted">Learning panel</span></div>
                <div class="auth-stat"><strong>Verify</strong><span class="muted">Certificate records</span></div>
            </div>
        </div>

        <div class="auth-card">
            <div class="auth-brand">
                <div class="auth-mark">RT</div>
                <div>
                    <p class="auth-title">Login</p>
                    <p class="muted" style="margin:6px 0 0">Access your dashboard</p>
                </div>
            </div>

            @if(session('message'))
                <div class="alert">{{ session('message') }}</div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="auth-form">
                @csrf

                <div class="auth-field">
                    <label>{{ trans('global.login_email') }}</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="student@example.com">
                    @if($errors->has('email'))<div class="auth-error">{{ $errors->first('email') }}</div>@endif
                </div>

                <div class="auth-field">
                    <label>{{ trans('global.login_password') }}</label>
                    <input type="password" name="password" required placeholder="Enter password">
                    @if($errors->has('password'))<div class="auth-error">{{ $errors->first('password') }}</div>@endif
                </div>

                <div class="auth-row">
                    <label class="auth-check">
                        <input type="checkbox" name="remember">
                        {{ trans('global.remember_me') }}
                    </label>
                    @if(Route::has('password.request'))
                        <a class="auth-link" href="{{ route('password.request') }}">{{ trans('global.forgot_password') }}</a>
                    @endif
                </div>

                <button type="submit" class="btn primary auth-submit">{{ trans('global.login') }}</button>
            </form>

            <div class="auth-switch">
                New student? <a class="auth-link" href="{{ route('register') }}">Create account</a>
            </div>
        </div>
    </div>
</section>
@endsection
