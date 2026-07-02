@extends('layouts.admin')

@section('page-title', 'Enroll Student')

@section('content')
<div class="admin-page-head">
    <div><h2 class="admin-page-title">Enroll Student</h2><p class="admin-page-subtitle">Manually assign a course to a student.</p></div>
</div>

<form method="POST" action="{{ route('admin.enrollments.store') }}">
    @csrf
    <div class="page-card" style="padding:24px">
        <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:16px">
            <div>
                <label style="font-weight:700;color:#475569">Student</label>
                <select name="user_id" class="form-control" required>
                    <option value="">Select student</option>
                    @foreach($students as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label style="font-weight:700;color:#475569">Course</label>
                <select name="course_id" class="form-control" required>
                    <option value="">Select course</option>
                    @foreach($courses as $id => $title)
                        <option value="{{ $id }}">{{ $title }}</option>
                    @endforeach
                </select>
            </div>
            <div><label style="font-weight:700;color:#475569">Amount Paid</label><input class="form-control" type="number" step="0.01" name="amount_paid" value="0"></div>
            <div>
                <label style="font-weight:700;color:#475569">Payment Status</label>
                <select class="form-control" name="payment_status">
                    <option value="manual">Manual</option>
                    <option value="paid">Paid</option>
                    <option value="pending_gateway">Pending Gateway</option>
                    <option value="failed">Failed</option>
                </select>
            </div>
            <div style="grid-column:1/-1"><label style="font-weight:700;color:#475569">Transaction ID</label><input class="form-control" name="transaction_id"></div>
        </div>
        <div style="display:flex;justify-content:flex-end;gap:10px;margin-top:20px">
            <a class="btn-outline" href="{{ route('admin.enrollments.index') }}">Cancel</a>
            <button class="btn-primary" type="submit"><i class="fas fa-save"></i> Save</button>
        </div>
    </div>
</form>
@endsection
