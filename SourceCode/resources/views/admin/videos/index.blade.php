@extends('layouts.admin')
@section('title', 'Quản lý video')
@section('content')
    <h1>Quản lý video</h1>
    <a href="{{ route('admin.videos.create') }}" class="btn btn-primary mb-3">Thêm video</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tiêu đề</th>
                <th>Thumbnail</th>
                <th>Link</th>
                <th>Ngày đăng</th>
                <th>Thời lượng</th>
                <th>Lượt xem</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($videos as $video)
            <tr>
                <td>{{ $video->id }}</td>
                <td>{{ $video->title }}</td>
                <td><img src="{{ $video->thumbnail }}" width="80"></td>
                <td><a href="{{ $video->link }}" target="_blank">Xem</a></td>
                <td>{{ $video->date_posted }}</td>
                <td>{{ $video->duration }}</td>
                <td>{{ $video->views }}</td>
                <td>
                    <a href="{{ route('admin.videos.edit', $video->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                    <form action="{{ route('admin.videos.destroy', $video->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Xoá video này?')">Xoá</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $videos->links() }}
@endsection