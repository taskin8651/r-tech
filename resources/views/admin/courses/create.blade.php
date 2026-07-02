@extends('layouts.admin')

@section('page-title', 'Add Course')

@section('content')
<div class="admin-page-head">
    <div><h2 class="admin-page-title">Add Course</h2><p class="admin-page-subtitle">Create frontend course, syllabus modules and lessons.</p></div>
</div>

<form method="POST" action="{{ route('admin.courses.store') }}" enctype="multipart/form-data">
    @csrf
    @include('admin.courses.form')
</form>
@endsection
