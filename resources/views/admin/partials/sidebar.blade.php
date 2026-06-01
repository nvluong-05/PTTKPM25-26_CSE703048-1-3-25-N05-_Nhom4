<div class="sidebar p-4">
    <h2 class="fs-4 fw-bold text-white mb-4">Quản trị</h2>
    <ul class="nav flex-column mb-4">
        <li class="nav-item mb-2">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a>
        </li>
        <li class="nav-item mb-2">
            <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">Người dùng</a>
        </li>
        <li class="nav-item mb-2">
            <a href="{{ route('admin.fields.index') }}" class="nav-link {{ request()->routeIs('admin.fields.*') ? 'active' : '' }}">Sân bóng</a>
        </li>
        <li class="nav-item mb-2">
            <a href="{{ route('admin.bookings.index') }}" class="nav-link {{ request()->routeIs('admin.bookings.*') ? 'active' : '' }}">Đặt sân</a>
        </li>
        <li class="nav-item mb-2">
            <a href="{{ route('admin.articles.index') }}" class="nav-link {{ request()->routeIs('admin.articles.*') ? 'active' : '' }}">Tin tức</a>
            <ul class="nav flex-column ms-3">
                <li class="nav-item mb-1">
                    <a href="{{ route('admin.articles.index') }}" class="nav-link {{ request()->routeIs('admin.articles.index') ? 'active' : '' }}">Danh sách</a>
                </li>
                <li class="nav-item mb-1">
                    <a href="{{ route('admin.articles.create') }}" class="nav-link {{ request()->routeIs('admin.articles.create') ? 'active' : '' }}">Thêm mới</a>
                </li>
                <li class="nav-item mb-1">
                    <a href="{{ route('admin.articles.stats') }}" class="nav-link {{ request()->routeIs('admin.articles.stats') ? 'active' : '' }}">Thống kê</a>
                </li>
            </ul>
        </li>
        <li class="nav-item mb-2">
            <a href="{{ route('admin.videos.index') }}" class="nav-link {{ request()->routeIs('admin.videos.*') ? 'active' : '' }}">Quản lý video</a>
        </li>
    </ul>
    </ul>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn btn-danger mt-4">Đăng xuất</button>
    </form>
</div>