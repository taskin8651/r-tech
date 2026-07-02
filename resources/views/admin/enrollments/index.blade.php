@extends('layouts.admin')

@section('page-title', 'Enrollments')

@section('content')
<div class="admin-page-head">
    <div>
        <h2 class="admin-page-title">Enrollments & Certificates</h2>
        <p class="admin-page-subtitle">Assign courses, track progress, payment status and upload final certificates.</p>
    </div>
    <a href="{{ route('admin.enrollments.create') }}" class="btn-primary"><i class="fas fa-plus"></i> Enroll Student</a>
</div>

<div class="stats-grid">
    <div class="stat-card"><p class="stat-label">Total Enrollments</p><p class="stat-value">{{ $enrollments->count() }}</p></div>
    <div class="stat-card"><p class="stat-label">Completed</p><p class="stat-value">{{ $enrollments->where('progress', 100)->count() }}</p></div>
    <div class="stat-card"><p class="stat-label">Certificates Uploaded</p><p class="stat-value">{{ $enrollments->filter->certificate->count() }}</p></div>
    <div class="stat-card"><p class="stat-label">Revenue</p><p class="stat-value">Rs. {{ number_format($enrollments->sum('amount_paid'), 0) }}</p></div>
</div>

<div class="page-card" style="padding:14px;margin-bottom:16px">
    <div style="display:flex;gap:10px;flex-wrap:wrap">
        <a class="btn-outline" href="{{ route('admin.enrollments.index') }}">All</a>
        <a class="btn-outline" href="{{ route('admin.enrollments.index', ['certificate' => 'uploaded']) }}">Certificate Uploaded</a>
        <a class="btn-outline" href="{{ route('admin.enrollments.index', ['certificate' => 'pending']) }}">Certificate Pending</a>
        <a class="btn-outline" href="{{ route('admin.enrollments.index', ['payment_status' => 'paid']) }}">Paid</a>
        <a class="btn-outline" href="{{ route('admin.enrollments.index', ['payment_status' => 'manual']) }}">Manual</a>
    </div>
</div>

<div class="page-card">
    <div class="page-card-header">
        <p class="page-card-title">Student Enrollments</p>
        <span class="page-card-note"><i class="fas fa-certificate"></i> Certificates are uploaded by admin</span>
    </div>
    <div class="page-card-table">
        <table class="min-w-full datatable datatable-Enrollment">
            <thead>
            <tr>
                <th>ID</th>
                <th>Student</th>
                <th>Course</th>
                <th>Payment</th>
                <th>Progress</th>
                <th>Certificate</th>
                <th style="text-align:right;">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($enrollments as $enrollment)
                <tr>
                    <td><span class="id-text">#{{ $enrollment->id }}</span></td>
                    <td>
                        <p class="table-main-text">{{ $enrollment->user->name }}</p>
                        <p class="table-sub-text">{{ $enrollment->user->email }}</p>
                    </td>
                    <td>{{ $enrollment->course->title }}</td>
                    <td>
                        <span class="role-tag">{{ ucfirst(str_replace('_', ' ', $enrollment->payment_status)) }}</span>
                        <p class="table-sub-text">Rs. {{ number_format($enrollment->amount_paid, 0) }}</p>
                    </td>
                    <td>{{ $enrollment->progress }}%</td>
                    <td>
                        @if($enrollment->certificate && $enrollment->certificate->file_url)
                            <a class="btn-outline" href="{{ $enrollment->certificate->file_url }}" target="_blank">View File</a>
                        @else
                            <span class="table-sub-text">Not uploaded</span>
                        @endif
                    </td>
                    <td>
                        <div class="action-row">
                            <a class="btn-outline btn-outline-edit" href="{{ route('admin.enrollments.edit', $enrollment) }}"><i class="fas fa-pencil-alt"></i> Manage</a>
                            <form method="POST" action="{{ route('admin.enrollments.destroy', $enrollment) }}" style="display:inline" onsubmit="return confirm('Remove enrollment?')">
                                @csrf @method('DELETE')
                                <button class="btn-outline btn-outline-danger" type="submit"><i class="fas fa-trash"></i> Delete</button>
                            </form>
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
$(function () { $('.datatable-Enrollment').DataTable({ order: [[0, 'desc']] }); });
</script>
@endsection
