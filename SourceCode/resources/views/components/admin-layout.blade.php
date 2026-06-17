{{-- 
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Admin - {{ $title ?? 'Quản trị' }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Admin Panel</a>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.users') }}">Users</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.settings') }}">Settings</a></li>
            </ul>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-outline-light" type="submit">Đăng xuất</button>
            </form>
        </div>
    </nav>
    <div class="container">
        {{ $slot }}
    </div>
    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p>© 2025 Admin Panel</p>
    </footer>
</body>
</html> --}}