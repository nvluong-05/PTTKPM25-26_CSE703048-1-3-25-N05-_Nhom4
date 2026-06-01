@extends('layouts.admin')
@section('title', 'Sửa booking')
@section('content')
    <div class="card shadow mb-4" style="max-width: 600px; margin: 0 auto;">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Sửa thông tin đặt sân</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.bookings.update', $booking->id) }}">
                @csrf @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Người đặt</label>
                    <select name="user_id" class="form-select" required>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" @if($booking->user_id == $user->id) selected @endif>
                                {{ $user->name }} ({{ $user->email }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Sân bóng</label>
                    <select name="field_id" class="form-select" required>
                        @foreach($fields as $field)
                            <option value="{{ $field->id }}" @if($booking->field_id == $field->id) selected @endif>
                                {{ $field->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Ngày đặt</label>
                    <input type="date" name="booking_date" class="form-control" value="{{ $booking->booking_date }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Giờ bắt đầu</label>
                    <input type="time" name="start_time" class="form-control" value="{{ $booking->start_time }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Giờ kết thúc</label>
                    <input type="time" name="end_time" class="form-control" value="{{ $booking->end_time }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tổng tiền (VNĐ)</label>
                    <input type="number" name="total_price" class="form-control" value="{{ $booking->total_price }}" required>
                </div>
                <button type="submit" class="btn btn-success">Cập nhật</button>
                <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary ms-2">Quay lại</a>
            </form>
        </div>
    </div>
@endsection