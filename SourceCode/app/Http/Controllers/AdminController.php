<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Field;
use App\Models\Booking;

class AdminController extends Controller
{
    public function dashboard()
    {
        $userCount    = User::count();
        $fieldCount   = Field::count();
        $bookingCount = Booking::count();

        // Doanh thu theo từng sân
        $revenueByField = Booking::with('field')
            ->where('status', 'paid')
            ->selectRaw('field_id, SUM(total_price) as total_revenue')
            ->groupBy('field_id')
            ->get()
            ->map(fn($b) => [
                'name'    => $b->field->name ?? 'Không rõ',
                'revenue' => (float) $b->total_revenue,
            ]);

        // Doanh thu theo tháng trong năm hiện tại
        $revenueByMonth = Booking::where('status', 'paid')
            ->whereYear('booking_date', now()->year)
            ->selectRaw('MONTH(booking_date) as month, SUM(total_price) as total_revenue')
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->map(fn($b) => [
                'month'   => 'Tháng ' . $b->month,
                'revenue' => (float) $b->total_revenue,
            ]);

        // Tổng doanh thu
        $totalRevenue = Booking::where('status', 'paid')->sum('total_price');

        return view('admin.dashboard', compact(
            'userCount',
            'fieldCount',
            'bookingCount',
            'revenueByField',
            'revenueByMonth',
            'totalRevenue'
        ));
    }

    public function users()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function settings()
    {
        return view('admin.settings');
    }
}
