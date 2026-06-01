@extends('layouts.admin')
@section('content')
<h2>Sửa bài viết</h2>
<form action="{{ route('admin.articles.update', $article->id) }}" method="POST">
    @csrf @method('PUT')
    <input name="title" value="{{ $article->title }}" class="form-input mb-2" required>
    <textarea name="description" class="form-textarea mb-2">{{ $article->description }}</textarea>
    <input name="category" value="{{ $article->category }}" class="form-input mb-2">
    <input name="date_posted" type="date" value="{{ $article->date_posted }}" class="form-input mb-2">
    <input name="image_url" value="{{ $article->image_url }}" class="form-input mb-2">
    <input name="read_more_link" value="{{ $article->read_more_link }}" class="form-input mb-2">
    <button type="submit" class="btn btn-primary">Cập nhật</button>
</form>
@endsection