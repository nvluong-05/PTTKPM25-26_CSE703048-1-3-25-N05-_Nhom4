@extends('layouts.admin')
@section('title', 'Thêm sân bóng')
@section('content')
    <h1 class="mb-4">Thêm sân bóng</h1>
    <form method="POST" action="{{ route('admin.fields.store') }}">
        @csrf
        <input type="text" name="name" placeholder="Tên sân" required>
        <input type="text" name="address" placeholder="Địa chỉ" required>
        <input type="number" name="price_per_hour" placeholder="Giá/giờ" required>
        <input type="text" name="image" placeholder="Link ảnh sân bóng">
        <input type="text" name="type" placeholder="Loại sân ">
        <button type="submit">Lưu</button>
    </form>
@endsection