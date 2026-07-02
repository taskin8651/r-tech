@extends('layouts.admin')

@section('page-title', 'Edit Course')

@section('content')
<div class="admin-page-head">
    <div><h2 class="admin-page-title">Edit Course</h2><p class="admin-page-subtitle">{{ $course->title }}</p></div>
</div>

<form method="POST" action="{{ route('admin.courses.update', $course) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @include('admin.courses.form')
</form>
@endsection
