@extends('layouts.admin')
@section('title', 'Thêm booking')
@section('content')
    <h1 class="mb-4">Thêm booking</h1>
    <form method="POST" action="{{ route('admin.bookings.store') }}">
        @csrf
        <select name="user_id" required>
            <option value="">Chọn người đặt</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
            @endforeach
        </select>
        <select name="field_id" required>
            <option value="">Chọn sân</option>
            @foreach($fields as $field)
                <option value="{{ $field->id }}">{{ $field->name }}</option>
            @endforeach
        </select>
        <input type="date" name="booking_date" required>
        <input type="time" name="start_time" required>
        <input type="time" name="end_time" required>
        <input type="number" name="total_price" placeholder="Tổng tiền" required>
        <button type="submit">Lưu</button>
    </form>
@endsection
