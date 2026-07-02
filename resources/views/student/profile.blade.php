@extends('layouts.frontend')

@section('title', 'My Profile | R Tech Computer')

@section('content')
<section class="page">
    <div class="wrap">
        @if(session('message'))<div class="alert">{{ session('message') }}</div>@endif

        <div class="card profile-head">
            <div class="profile-avatar">
                @if($user->avatar)
                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}">
                @else
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                @endif
            </div>
            <div>
                <span class="pill">Student Profile</span>
                <h1 style="font-size:clamp(34px,5vw,62px)">{{ $user->name }}</h1>
                <p class="muted">{{ $user->email }} @if($user->phone) / {{ $user->phone }} @endif</p>
                <div style="display:flex;gap:10px;flex-wrap:wrap;margin-top:12px">
                    <span class="pill">{{ $user->enrollments->count() }} Courses</span>
                    <span class="pill">{{ $user->certificates->count() }} Certificates</span>
                </div>
            </div>
        </div>

        <div class="grid grid-2" style="margin-top:22px">
            <form class="card" method="POST" action="{{ route('student.profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <h2 style="font-size:30px">Edit Details</h2>
                <div class="form-row">
                    <div class="field"><label>Name</label><input name="name" value="{{ old('name', $user->name) }}" required></div>
                    <div class="field"><label>Email</label><input type="email" name="email" value="{{ old('email', $user->email) }}" required></div>
                    <div class="field"><label>Phone</label><input name="phone" value="{{ old('phone', $user->phone) }}"></div>
                    <div class="field"><label>Profile Image</label><input type="file" name="avatar" accept="image/*"></div>
                    <div class="field" style="grid-column:1/-1"><label>Address</label><textarea name="address">{{ old('address', $user->address) }}</textarea></div>
                </div>
                <button class="btn primary" style="margin-top:18px" type="submit">Save Profile</button>
            </form>

            <form class="card" method="POST" action="{{ route('student.profile.password') }}">
                @csrf
                @method('PUT')
                <h2 style="font-size:30px">Change Password</h2>
                <div class="field" style="margin-bottom:14px"><label>Current Password</label><input type="password" name="current_password" required></div>
                <div class="field" style="margin-bottom:14px"><label>New Password</label><input type="password" name="password" required></div>
                <div class="field"><label>Confirm Password</label><input type="password" name="password_confirmation" required></div>
                <button class="btn primary" style="margin-top:18px" type="submit">Update Password</button>
            </form>
        </div>

        <div class="card" style="margin-top:22px">
            <h2 style="font-size:30px">Profile Summary</h2>
            <div class="grid grid-3">
                <div><span class="pill">Enrolled</span><p class="muted">{{ $user->enrollments->count() }} courses</p></div>
                <div><span class="pill">Certificates</span><p class="muted">{{ $user->certificates->count() }} uploaded records</p></div>
                <div><span class="pill">Member Since</span><p class="muted">{{ $user->created_at->format('d M Y') }}</p></div>
            </div>
        </div>
    </div>
</section>
@endsection
