@extends('layouts.frontend')

@section('title', 'Payment | ' . $course->title)

@section('content')
<section class="page">
    <div class="wrap">
        <div class="card" style="max-width:720px;margin:auto">
            <span class="pill">Razorpay Checkout</span>
            <h1>{{ $course->title }}</h1>
            <p class="muted">Amount payable: Rs. {{ number_format($course->display_price, 0) }}</p>
            <button
                id="payButton"
                class="btn primary"
                data-key="{{ $key }}"
                data-amount="{{ $order['amount'] }}"
                data-description="{{ $course->title }}"
                data-order-id="{{ $order['id'] }}"
                data-user-name="{{ auth()->user()->name }}"
                data-user-email="{{ auth()->user()->email }}"
            >Pay Now</button>
            <form id="successForm" method="POST" action="{{ route('student.courses.payment-success', $course) }}" style="display:none">
                @csrf
                <input name="razorpay_payment_id" id="razorpay_payment_id">
                <input name="razorpay_order_id" id="razorpay_order_id">
                <input name="razorpay_signature" id="razorpay_signature">
            </form>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
@endsection
