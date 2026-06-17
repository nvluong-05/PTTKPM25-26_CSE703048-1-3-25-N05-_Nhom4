@extends('layouts.admin')
@section('title', 'Thêm người dùng')
@section('content')
    <h1 class="mb-4">Thêm người dùng</h1>
    <form method="POST" action="{{ route('admin.users.store') }}">
        @csrf
        <input type="text" name="name" placeholder="Tên" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Mật khẩu" required>
        <button type="submit">Lưu</button>
    </form>
@endsection