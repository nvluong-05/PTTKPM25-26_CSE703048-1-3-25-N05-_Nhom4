@extends('layouts.admin')
@section('title', 'Quản lý sân bóng')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Quản lý sân bóng</h1>
        <a href="{{ route('admin.fields.create') }}" class="btn btn-primary">Thêm sân mới</a>
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
                        <th>Tên sân</th>
                        <th>Loại sân</th>
                        <th>Địa chỉ</th>
                        <th>Giá/giờ</th>
                        <th>Ảnh</th>
                        <th class="text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($fields as $field)
                    <tr>
                        <td>{{ $field->id }}</td>
                        <td>{{ $field->name }}</td>
                        <td>{{ $field->type }}</td>
                        <td>{{ $field->address }}</td>
                        <td>{{ number_format($field->price_per_hour) }} đ</td>
                        <td>
                            @if($field->image)
                                <img src="{{ $field->image }}" alt="{{ $field->name }}" style="max-width: 80px; height: 50px; object-fit:cover;">
                            @else
                                <span class="text-muted">Không có ảnh</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.fields.edit', $field->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                            <form action="{{ route('admin.fields.destroy', $field->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn chắc chắn muốn xóa?')">Xóa</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
