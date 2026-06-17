@extends('layouts.admin')
@section('content')
@if(session('success'))
    <div class="alert alert-success mb-3">
        {{ session('success') }}
    </div>
@endif
<h2>Danh sách bài viết</h2>
<a href="{{ route('admin.articles.create') }}" class="btn btn-success mb-2">Thêm mới</a>
<table class="table-auto w-full">
    <thead>
        <tr>
            <th class="px-4">Tiêu đề</th>
            <th class="px-4 text-center">Lượt xem</th>
            <th class="px-4 text-center">Ngày đăng</th>
            <th class="px-4 text-center">Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach($articles as $article)
        <tr class="align-middle" style="height: 60px;">
            <td class="py-3 px-4">{{ $article->title }}</td>
            <td class="py-3 px-4 text-center">{{ $article->views }}</td>
            <td class="py-3 px-4 text-center">{{ $article->date_posted }}</td>
            <td class="py-3 px-4 text-center">
                <a href="{{ route('admin.articles.edit', $article->id) }}" class="btn btn-warning">Sửa</a>
                <form action="{{ route('admin.articles.destroy', $article->id) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Xoá bài viết này?')">Xoá</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection