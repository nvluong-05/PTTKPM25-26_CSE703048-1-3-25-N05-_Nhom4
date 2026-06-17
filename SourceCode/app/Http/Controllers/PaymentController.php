<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index($bookingId)
    {
        $booking = \App\Models\Booking::where('id', $bookingId)
            ->where('user_id', auth()->id())
            ->firstOrFail();
        return view('payment.index', compact('booking'));
    }

    public function success($bookingId)
    {
        $booking = \App\Models\Booking::where('id', $bookingId)
            ->where('user_id', auth()->id())
            ->firstOrFail();
        $booking->status = 'paid';
        $booking->save();
        return response()->json(['success' => true]);
    }
}