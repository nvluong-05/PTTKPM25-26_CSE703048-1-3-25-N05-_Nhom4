@extends('layouts.admin')
@section('title', 'Quản lý đặt sân')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Quản lý đặt sân</h1>
        <a href="{{ route('admin.bookings.create') }}" class="btn btn-primary">Thêm booking</a>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="card shadow">
        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Người đặt</th>
                        <th>Sân</th>
                        <th>Ngày</th>
                        <th>Giờ</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th class="text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $booking->id }}</td>
                        <td>{{ $booking->user->name ?? 'N/A' }}</td>
                        <td>{{ $booking->field->name ?? 'N/A' }}</td>
                        <td>{{ $booking->booking_date }}</td>
                        <td>{{ $booking->start_time }} - {{ $booking->end_time }}</td>
                        <td>{{ number_format($booking->total_price) }} đ</td>
                        <td>
                            @if($booking->status === 'paid')
                                <span class="badge bg-success">Đã thanh toán</span>
                            @elseif($booking->status === 'pending')
                                <span class="badge bg-warning text-dark">Chờ thanh toán</span>
                            @elseif($booking->status === 'canceled')
                                <span class="badge bg-danger">Đã hủy</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.bookings.edit', $booking->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                            <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Xóa booking này?')">Xóa</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection