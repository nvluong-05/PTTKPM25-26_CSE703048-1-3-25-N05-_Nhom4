@extends('layouts.admin')
@section('title', 'Sửa sân bóng')
@section('content')
<div class="card shadow mb-4" style="max-width: 600px; margin: 0 auto;">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">Sửa thông tin sân bóng</h4>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.fields.update', $field->id) }}">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label">Tên sân</label>
                <input type="text" name="name" class="form-control" value="{{ $field->name }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Loại sân</label>
                <input type="text" name="type" class="form-control" value="{{ $field->type }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Địa chỉ</label>
                <input type="text" name="address" class="form-control" value="{{ $field->address }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Giá/giờ (VNĐ)</label>
                <input type="number" name="price_per_hour" class="form-control" value="{{ $field->price_per_hour }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Link ảnh sân bóng</label>
                <input type="text" name="image" class="form-control" value="{{ $field->image }}">
                @if($field->image)
                    <div class="mt-2">
                        <img src="{{ $field->image }}" alt="Ảnh sân bóng" style="max-width: 100%; height: 120px; object-fit:cover;">
                    </div>
                @endif
            </div>
            <button type="submit" class="btn btn-success">Cập nhật</button>
            <a href="{{ route('admin.fields.index') }}" class="btn btn-secondary ms-2">Quay lại</a>
        </form>
    </div>
</div>
@endsection