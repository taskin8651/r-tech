@extends('layouts.admin')

@section('page-title', 'Manage Enrollment')

@section('content')
<div class="admin-page-head">
    <div>
        <h2 class="admin-page-title">{{ $enrollment->user->name }}</h2>
        <p class="admin-page-subtitle">{{ $enrollment->course->title }}</p>
    </div>
</div>

<form method="POST" action="{{ route('admin.enrollments.update', $enrollment) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="page-card" style="padding:24px">
        <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:16px">
            <div>
                <label style="font-weight:700;color:#475569">Enrollment Status</label>
                <select class="form-control" name="status">
                    @foreach(['active', 'paused', 'completed', 'cancelled'] as $status)
                        <option value="{{ $status }}" @selected($enrollment->status === $status)>{{ ucfirst($status) }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label style="font-weight:700;color:#475569">Payment Status</label>
                <select class="form-control" name="payment_status">
                    @foreach(['manual', 'paid', 'pending_gateway', 'failed', 'free'] as $status)
                        <option value="{{ $status }}" @selected($enrollment->payment_status === $status)>{{ ucfirst(str_replace('_', ' ', $status)) }}</option>
                    @endforeach
                </select>
            </div>
            <div><label style="font-weight:700;color:#475569">Amount Paid</label><input class="form-control" type="number" step="0.01" name="amount_paid" value="{{ $enrollment->amount_paid }}"></div>
            <div><label style="font-weight:700;color:#475569">Transaction ID</label><input class="form-control" name="transaction_id" value="{{ $enrollment->transaction_id }}"></div>
            <div><label style="font-weight:700;color:#475569">Progress %</label><input class="form-control" type="number" min="0" max="100" name="progress" value="{{ $enrollment->progress }}"></div>
            <div><label style="font-weight:700;color:#475569">Certificate ID</label><input class="form-control" name="certificate_id" value="{{ $enrollment->certificate->certificate_id ?? '' }}" placeholder="Auto if empty"></div>
            <div style="grid-column:1/-1">
                <label style="font-weight:700;color:#475569">Upload Certificate File</label>
                <input class="form-control" type="file" name="certificate_file" accept=".pdf,.jpg,.jpeg,.png">
                <p style="color:#64748b;font-size:12px;margin-top:6px">Upload final certificate PDF/image. System will not generate certificate automatically.</p>
                @if($enrollment->certificate && $enrollment->certificate->file_url)
                    <a class="btn-outline" href="{{ $enrollment->certificate->file_url }}" target="_blank">Current Certificate</a>
                @endif
            </div>
        </div>
        <div style="display:flex;justify-content:flex-end;gap:10px;margin-top:20px">
            <a class="btn-outline" href="{{ route('admin.enrollments.index') }}">Cancel</a>
            <button class="btn-primary" type="submit"><i class="fas fa-save"></i> Save Changes</button>
        </div>
    </div>
</form>
@endsection
