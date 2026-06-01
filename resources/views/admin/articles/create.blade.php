@extends('layouts.admin')
@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<h2 class="mb-4">Thêm bài viết mới</h2>
<div class="card p-4 mx-auto" style="max-width: 600px;">
    <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Tiêu đề</label>
            <input name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Mô tả</label>
            <textarea name="description" class="form-control" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Chuyên mục</label>
            <input name="category" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Ngày đăng</label>
            <input name="date_posted" type="date" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Link ảnh</label>
            <input name="image_url" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Link đọc tiếp</label>
            <input name="read_more_link" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Thêm</button>
    </form>
</div>
@endsection