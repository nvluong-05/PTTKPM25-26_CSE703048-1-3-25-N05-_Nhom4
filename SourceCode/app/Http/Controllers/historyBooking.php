<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class historyBooking extends Controller
{
    public function index() {
        $user = auth()->user();
        $booking = $user->booking()->with('san')->lastest()->get();

        return view('history.index', compact('bookings'));
    }
}
