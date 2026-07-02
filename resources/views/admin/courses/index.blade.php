@extends('layouts.admin')

@section('page-title', 'Courses')

@section('content')
<style>
    .course-admin-thumb{width:74px;height:54px;border-radius:10px;overflow:hidden;background:#0f172a;flex:0 0 auto}
    .course-admin-thumb img{width:100%;height:100%;object-fit:cover;display:block}
</style>
<div class="admin-page-head">
    <div>
        <h2 class="admin-page-title">Courses</h2>
        <p class="admin-page-subtitle">Manage dynamic courses, modules, lessons, pricing and certificates.</p>
    </div>
    @can('course_create')
        <a href="{{ route('admin.courses.create') }}" class="btn-primary"><i class="fas fa-plus"></i> Add Course</a>
    @endcan
</div>

<div class="stats-grid">
    <div class="stat-card"><p class="stat-label">Total Courses</p><p class="stat-value">{{ $courses->count() }}</p></div>
    <div class="stat-card"><p class="stat-label">Active</p><p class="stat-value">{{ $courses->where('is_active', true)->count() }}</p></div>
    <div class="stat-card"><p class="stat-label">Featured</p><p class="stat-value">{{ $courses->where('is_featured', true)->count() }}</p></div>
    <div class="stat-card"><p class="stat-label">Lessons</p><p class="stat-value">{{ $courses->sum(fn($course) => $course->modules->sum(fn($module) => $module->lessons->count())) }}</p></div>
</div>

<div class="page-card">
    <div class="page-card-header">
        <p class="page-card-title">All Courses</p>
        <span class="page-card-note"><i class="fas fa-database"></i> Frontend reads from this list</span>
    </div>
    <div class="page-card-table">
        <table class="min-w-full datatable datatable-Course">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Course</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Modules</th>
                    <th>Status</th>
                    <th style="text-align:right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($courses as $course)
                    <tr>
                        <td><span class="id-text">#{{ $course->id }}</span></td>
                        <td>
                            <div class="inline-flex-center">
                                <div class="course-admin-thumb"><img src="{{ $course->image_url }}" alt="{{ $course->title }}"></div>
                                <div>
                                    <p class="table-main-text">{{ $course->title }}</p>
                                    <p class="table-sub-text">{{ $course->duration }} / {{ $course->level }}</p>
                                </div>
                            </div>
                        </td>
                        <td>{{ $course->category->name ?? '-' }}</td>
                        <td>Rs. {{ number_format($course->display_price, 0) }}</td>
                        <td>{{ $course->modules->count() }}</td>
                        <td>
                            <span class="role-tag">{{ $course->is_active ? 'Active' : 'Hidden' }}</span>
                            @if($course->is_featured)<span class="role-tag">Featured</span>@endif
                        </td>
                        <td>
                            <div class="action-row">
                                @can('course_show')<a href="{{ route('admin.courses.show', $course) }}" class="btn-outline"><i class="fas fa-eye"></i> View</a>@endcan
                                @can('course_edit')<a href="{{ route('admin.courses.edit', $course) }}" class="btn-outline btn-outline-edit"><i class="fas fa-pencil-alt"></i> Edit</a>@endcan
                                @can('course_delete')
                                    <form method="POST" action="{{ route('admin.courses.destroy', $course) }}" onsubmit="return confirm('Delete this course?')" style="display:inline">
                                        @csrf @method('DELETE')
                                        <button class="btn-outline btn-outline-danger" type="submit"><i class="fas fa-trash"></i> Delete</button>
                                    </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
@parent
<script>
$(function () {
    $('.datatable-Course').DataTable({ order: [[0, 'desc']] });
});
</script>
@endsection
