@extends('layouts.admin')
@section('title', 'Sửa video')
@section('content')
    <h1>Sửa video</h1>
    <form action="{{ route('admin.videos.update', $video->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Tiêu đề</label>
            <input type="text" name="title" class="form-control" value="{{ $video->title }}" required>
        </div>
        <div class="mb-3">
            <label>Thumbnail (URL)</label>
            <input type="text" name="thumbnail" class="form-control" value="{{ $video->thumbnail }}" required>
        </div>
        <div class="mb-3">
            <label>Link video</label>
            <input type="text" name="link" class="form-control" value="{{ $video->link }}" required>
        </div>
        <div class="mb-3">
            <label>Ngày đăng</label>
            <input type="date" name="date_posted" class="form-control" value="{{ $video->date_posted }}" required>
        </div>
        <div class="mb-3">
            <label>Thời lượng</label>
            <input type="text" name="duration" class="form-control" value="{{ $video->duration }}" required>
        </div>
        <button type="submit" class="btn btn-success">Cập nhật</button>
        <a href="{{ route('admin.videos.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
@endsection