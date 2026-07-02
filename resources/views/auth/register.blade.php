@extends('layouts.frontend')

@section('title', 'Register | R Tech Computer')
@section('meta_description', 'Create a student account at R Tech Computer to enroll in courses, edit profile details and access uploaded certificates.')
@section('meta_keywords', 'R Tech Computer register, student registration, online computer course account')

@section('content')
<section class="auth-page">
    <div class="wrap auth-shell">
        <div class="auth-card">
            <div class="auth-brand">
                <div class="auth-mark">RT</div>
                <div>
                    <p class="auth-title">Register</p>
                    <p class="muted" style="margin:6px 0 0">Create student access</p>
                </div>
            </div>

            <form method="POST" action="{{ route('register') }}" class="auth-form">
                @csrf

                <div class="auth-field">
                    <label>{{ trans('global.user_name') }}</label>
                    <input type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="Full name">
                    @if($errors->has('name'))<div class="auth-error">{{ $errors->first('name') }}</div>@endif
                </div>

                <div class="auth-field">
                    <label>{{ trans('global.login_email') }}</label>
                    <input type="email" name="email" value="{{ old('email') }}" required placeholder="student@example.com">
                    @if($errors->has('email'))<div class="auth-error">{{ $errors->first('email') }}</div>@endif
                </div>

                <div class="auth-grid">
                    <div class="auth-field">
                        <label>{{ trans('global.login_password') }}</label>
                        <input type="password" name="password" required placeholder="Minimum 8 characters">
                        @if($errors->has('password'))<div class="auth-error">{{ $errors->first('password') }}</div>@endif
                    </div>
                    <div class="auth-field">
                        <label>{{ trans('global.login_password_confirmation') }}</label>
                        <input type="password" name="password_confirmation" required placeholder="Confirm password">
                    </div>
                </div>

                <button type="submit" class="btn primary auth-submit">{{ trans('global.register') }}</button>
            </form>

            <div class="auth-switch">
                Already registered? <a class="auth-link" href="{{ route('login') }}">Login here</a>
            </div>
        </div>

        <div class="auth-copy">
            <div>
                <span class="eyebrow">Student Account</span>
                <h1>Start learning with a clean student dashboard.</h1>
                <p class="muted">Create your account, enroll in courses, update your profile image and access certificates uploaded by admin after completion.</p>
            </div>
            <div class="auth-steps">
                <div class="auth-step"><span>01</span><div><strong>Register</strong><p class="muted" style="margin:4px 0 0">Create your student account.</p></div></div>
                <div class="auth-step"><span>02</span><div><strong>Enroll</strong><p class="muted" style="margin:4px 0 0">Choose courses from the dynamic catalogue.</p></div></div>
                <div class="auth-step"><span>03</span><div><strong>Learn</strong><p class="muted" style="margin:4px 0 0">Track lessons, progress and uploaded certificates.</p></div></div>
            </div>
        </div>
    </div>
</section>
@endsection
