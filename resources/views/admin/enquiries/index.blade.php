@extends('layouts.admin')

@section('page-title', 'Enquiries')

@section('content')
<div class="admin-page-head">
    <div>
        <h2 class="admin-page-title">Enquiries</h2>
        <p class="admin-page-subtitle">Admission/contact leads from frontend.</p>
    </div>
</div>

<div class="page-card" style="padding:14px;margin-bottom:16px">
    <div style="display:flex;gap:10px;flex-wrap:wrap">
        @foreach(['' => 'All', 'new' => 'New', 'contacted' => 'Contacted', 'converted' => 'Converted', 'closed' => 'Closed'] as $key => $label)
            <a class="btn-outline {{ request('status') === $key ? 'btn-outline-edit' : '' }}" href="{{ route('admin.enquiries.index', array_filter(['status' => $key])) }}">{{ $label }}</a>
        @endforeach
    </div>
</div>

<div class="page-card">
    <div class="page-card-table">
        <table class="min-w-full datatable datatable-Enquiry">
            <thead><tr><th>ID</th><th>Name</th><th>Contact</th><th>Course</th><th>Message</th><th>Status</th><th style="text-align:right;">Actions</th></tr></thead>
            <tbody>
            @foreach($enquiries as $enquiry)
                <tr>
                    <td>#{{ $enquiry->id }}</td>
                    <td><p class="table-main-text">{{ $enquiry->name }}</p><p class="table-sub-text">{{ $enquiry->created_at->format('d M Y') }}</p></td>
                    <td>{{ $enquiry->phone }}<br><span class="table-sub-text">{{ $enquiry->email }}</span></td>
                    <td>{{ $enquiry->course->title ?? '-' }}</td>
                    <td style="max-width:320px">{{ $enquiry->message }}</td>
                    <td>
                        <form method="POST" action="{{ route('admin.enquiries.update', $enquiry) }}">
                            @csrf @method('PUT')
                            <select name="status" onchange="this.form.submit()">
                                @foreach(['new', 'contacted', 'converted', 'closed'] as $status)
                                    <option value="{{ $status }}" @selected($enquiry->status === $status)>{{ ucfirst($status) }}</option>
                                @endforeach
                            </select>
                        </form>
                    </td>
                    <td>
                        <form method="POST" action="{{ route('admin.enquiries.destroy', $enquiry) }}" onsubmit="return confirm('Delete enquiry?')">
                            @csrf @method('DELETE')
                            <button class="btn-outline btn-outline-danger" type="submit">Delete</button>
                        </form>
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
<script>$(function(){ $('.datatable-Enquiry').DataTable({ order:[[0,'desc']] }); });</script>
@endsection
