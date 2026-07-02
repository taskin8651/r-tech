<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseEnrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    public function checkout(Course $course)
    {
        abort_if(! $course->is_active, 404);

        $key = config('services.razorpay.key');
        $secret = config('services.razorpay.secret');

        if (! $key || ! $secret || $course->display_price <= 0) {
            return redirect()->route('courses.show', $course)->with('message', 'Online payment is not configured yet. Please send an enquiry or contact admin for manual enrollment.');
        }

        $amount = (int) round($course->display_price * 100);
        $receipt = 'rtc_' . auth()->id() . '_' . $course->id . '_' . time();

        $response = Http::withBasicAuth($key, $secret)->post('https://api.razorpay.com/v1/orders', [
            'amount'          => $amount,
            'currency'        => 'INR',
            'receipt'         => $receipt,
            'payment_capture' => 1,
            'notes'           => [
                'course_id' => $course->id,
                'user_id'   => auth()->id(),
            ],
        ]);

        if (! $response->successful()) {
            return redirect()->route('courses.show', $course)->with('message', 'Payment gateway is not ready. Please contact admin.');
        }

        return view('student.checkout', [
            'course' => $course,
            'order'  => $response->json(),
            'key'    => $key,
        ]);
    }

    public function success(Request $request, Course $course)
    {
        abort_if(! $course->is_active, 404);

        $data = $request->validate([
            'razorpay_payment_id' => ['required', 'string'],
            'razorpay_order_id'   => ['required', 'string'],
            'razorpay_signature'  => ['nullable', 'string'],
        ]);

        $enrollment = CourseEnrollment::updateOrCreate(
            ['user_id' => auth()->id(), 'course_id' => $course->id],
            [
                'status'         => 'active',
                'amount_paid'    => $course->display_price,
                'payment_status' => 'paid',
                'transaction_id' => $data['razorpay_payment_id'],
                'progress'       => 0,
            ]
        );

        return redirect()->route('student.learn', $enrollment)->with('message', 'Payment successful. Course access unlocked.');
    }
}
