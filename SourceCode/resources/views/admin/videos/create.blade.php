@extends('layouts.admin')
@section('title', 'Thêm video')
@section('content')
    <h1>Thêm video</h1>
    <form action="{{ route('admin.videos.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Tiêu đề</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Thumbnail (URL)</label>
            <input type="text" name="thumbnail" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Link video</label>
            <input type="text" name="link" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Ngày đăng</label>
            <input type="date" name="date_posted" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Thời lượng</label>
            <input type="text" name="duration" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Lưu</button>
        <a href="{{ route('admin.videos.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
@endsection