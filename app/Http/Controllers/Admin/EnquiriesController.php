<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enquiry;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnquiriesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('course_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $enquiries = Enquiry::with('course')
            ->when(request('status'), fn ($query, $status) => $query->where('status', $status))
            ->latest()
            ->get();

        return view('admin.enquiries.index', compact('enquiries'));
    }

    public function update(Request $request, Enquiry $enquiry)
    {
        abort_if(Gate::denies('course_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $enquiry->update($request->validate([
            'status' => ['required', 'in:new,contacted,converted,closed'],
        ]));

        return back()->with('message', 'Enquiry status updated.');
    }

    public function destroy(Enquiry $enquiry)
    {
        abort_if(Gate::denies('course_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $enquiry->delete();

        return back()->with('message', 'Enquiry deleted.');
    }
}
