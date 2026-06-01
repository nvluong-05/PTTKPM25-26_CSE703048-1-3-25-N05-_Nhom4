@extends('layouts.admin')
@section('title', 'Sửa người dùng')
@section('content')
    <div class="card shadow mb-4" style="max-width: 500px; margin: 0 auto;">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Sửa thông tin người dùng</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
                @csrf @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Tên</label>
                    <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                </div>
                <button type="submit" class="btn btn-success">Cập nhật</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary ms-2">Quay lại</a>
            </form>
        </div>
    </div>
@endsection