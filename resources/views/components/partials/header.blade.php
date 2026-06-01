<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'DatSanBong')</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
  <header x-data="{ open: false }" class="bg-white shadow-sm sticky top-0 z-50">
    <div class="container mx-auto px-4 py-3">
      <div class="flex items-center justify-between">
        <div class="flex items-center">
          <a href="{{ route('main') }}" class="text-2xl font-['Pacifico'] text-primary">DatSanBong</a>
        </div>

        <!-- Desktop Navigation -->
        <nav class="hidden md:flex items-center space-x-8">
          <x-nav-link href="{{ route('main') }}" :active="request()->routeIs('main')" class="text-gray-800 hover:text-primary">Trang chủ</x-nav-link>
          <x-nav-link href="{{ route('components.partials.booking') }}" :active="request()->routeIs('components.partials.booking')" class="text-gray-800 hover:text-primary">Đặt sân</x-nav-link>
          <x-nav-link href="#" class="text-gray-800 hover:text-primary">Thanh toán</x-nav-link>
          <x-nav-link href="{{ route('profile.news.news') }}" :active="request()->routeIs('profile.news.news')">Tin tức</x-nav-link>
          <x-nav-link href="{{ route('news.infor') }}" :active="request()->routeIs('news.infor')" class="text-gray-800 hover:text-primary">Liên hệ</x-nav-link>
        </nav>

        <!-- Login/Register -->
        <div class="flex items-center space-x-4">
          @if (Route::has('login'))
          @auth
          <x-dropdown align="right" width="48">
            <x-slot name="trigger">
              <button class="flex items-center font-medium text-gray-800 hover:text-primary focus:outline-none transition">
                {{ Auth::user()->name }}
                <svg class="ml-1 h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                  <path d="M5.25 7.5L10 12.25L14.75 7.5H5.25Z" />
                </svg>
              </button>
            </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link href="{{ route('profile.edit') }}">Hồ sơ</x-dropdown-link>
                        <!-- Booking History -->
                        <x-dropdown-link :href="route('booking.history')">
                            {{__('Sân đã đặt')}}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link href="{{ route('logout') }}"
                                     onclick="event.preventDefault(); this.closest('form').submit();">
                                Đăng xuất
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            @else
                <a href="{{ route('login') }}" class="text-gray-800 hover:text-primary transition font-medium">Đăng nhập</a>
                <a href="{{ route('register') }}" class="bg-primary text-white py-2 px-4 rounded-button hover:bg-opacity-90 transition whitespace-nowrap">Đăng ký</a>
            @endauth
        @endif

          <!-- Mobile Toggle -->
          <button @click="open = ! open" class="md:hidden w-10 h-10 flex items-center justify-center focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16" />
              <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
      </div>

      <!-- Mobile Navigation -->
      <div :class="{ 'block': open, 'hidden': !open }" class="md:hidden mt-3">
        <x-responsive-nav-link href="{{ route('main') }}" :active="request()->routeIs('main')">Trang chủ</x-responsive-nav-link>
        <x-responsive-nav-link href="#" :active="request()->routeIs('booking')">Đặt sân</x-responsive-nav-link>
        {{-- <x-responsive-nav-link href="{{ route('payment.index') }}" ...>Thanh toán</x-responsive-nav-link> --}}
        <x-responsive-nav-link href="{{ route('profile.news.news') }}" :active="request()->routeIs('profile.news.news')">Tin tức</x-responsive-nav-link>
        <x-responsive-nav-link href="{{ route('news.infor') }}" :active="request()->routeIs('news.infor')">Liên hệ</x-responsive-nav-link>

        @if (Route::has('login'))
        @auth
        <x-responsive-nav-link href="{{ route('profile.edit') }}">Hồ sơ</x-responsive-nav-link>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <x-responsive-nav-link href="{{ route('logout') }}"
            onclick="event.preventDefault(); this.closest('form').submit();">
            Đăng xuất
          </x-responsive-nav-link>
        </form>
        @else
        <x-responsive-nav-link href="{{ route('login') }}">Đăng nhập</x-responsive-nav-link>
        <x-responsive-nav-link href="{{ route('register') }}">Đăng ký</x-responsive-nav-link>
        @endauth
        @endif
      </div>
    </div>
  </header>

  @yield('infor')
</body>

</html>