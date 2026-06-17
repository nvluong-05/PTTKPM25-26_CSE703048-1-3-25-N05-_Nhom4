<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tin tức - DatSanBong</title>

    <!-- CSS External -->
    <link rel="stylesheet" href="style.css">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <script src="tailwind-config.js"></script>

    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<x-app-layout>

    <body class="bg-gray-50">
        <!-- Main Content -->
        <main class="container mx-auto px-4 py-8">
            <!-- Page Title -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-800 text-center">Tin tức bóng đá</h1>

                <!-- Form tìm kiếm tin tức -->
                <form method="GET" action="{{ route('profile.news.news') }}" class="flex justify-center my-6">
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Tìm kiếm tin tức..."
                        class="border rounded-l px-4 py-2 w-72 focus:outline-none"
                    >
                    <button type="submit" class="bg-primary text-white px-4 py-2 rounded-r hover:bg-blue-700">
                        <i class="ri-search-line"></i> Tìm kiếm
                    </button>
                </form>

                <p class="text-gray-600 mt-2 text-center">Cập nhật những tin tức mới nhất về bóng đá trong nước và quốc tế
                </p>
            </div>
            <!-- Tin nổi bật -->
            <div class="mb-12">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Tin nổi bật</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($featured as $item)
                    <div class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-all duration-300" data-article-id="{{ $item->id }}">
                        <div class="relative h-64">
                            <img src="{{ $item->image_url }}" alt="Tin tức bóng đá" class="w-full h-full object-cover object-top">
                            @if($item->category)
                            <div class="absolute top-3 left-3 bg-primary text-white px-2 py-1 rounded text-sm">
                                {{ $item->category }}
                            </div>
                            @endif
                        </div>
                        <div class="p-5">
                            <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $item->title }}</h3>
                            <div class="flex items-center text-gray-500 text-sm mb-3">
                                <span class="flex items-center">
                                    <i class="ri-calendar-line mr-1"></i>
                                    {{ \Carbon\Carbon::parse($item->date_posted)->format('d/m/Y') }}
                                </span>
                                <span class="mx-2">•</span>
                                <span class="flex items-center">
                                    <i class="ri-eye-line mr-1"></i>
                                    <span class="views-count">{{ number_format($item->views) }} lượt xem</span>
                                </span>
                            </div>
                            <p class="text-gray-600 mb-4">{{ $item->description }}</p>
                            @if($item->read_more_link)
                            <a href="{{ route('news.read_more', $item->id) }}"
                               class="inline-flex items-center text-primary hover:underline read-more-btn"
                               data-link="{{ route('news.read_more', $item->id) }}"
                               data-article-id="{{ $item->id }}">
                                Đọc tiếp <i class="ri-arrow-right-line ml-1"></i>
                            </a>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Tin tức mới nhất (bỏ 2 tin nổi bật ra khỏi danh sách) -->
            <div class="mb-12">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Tin tức mới nhất</h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($articles as $article)
                    <div class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 news-card"
                         data-article-id="{{ $article->id }}">
                        <div class="relative h-48">
                            <img src="{{ $article->image_url }}" alt="Ảnh bài viết" class="w-full h-full object-cover object-top">
                            @if($article->category)
                            <div class="absolute top-3 left-3 bg-blue-500 text-white px-2 py-1 rounded text-sm">
                                {{ $article->category }}
                            </div>
                            @endif
                        </div>
                        <div class="p-4">
                            <h3 class="text-lg font-bold text-gray-800 mb-2">{{ $article->title }}</h3>
                            <div class="flex items-center text-gray-500 text-sm mb-3">
                                <span class="flex items-center">
                                    <i class="ri-calendar-line mr-1"></i>
                                    {{ \Carbon\Carbon::parse($article->date_posted)->format('d/m/Y') }}
                                </span>
                                <span class="mx-2">•</span>
                                <span class="flex items-center">
                                    <i class="ri-eye-line mr-1"></i>
                                    <span class="views-count">{{ number_format($article->views) }} lượt xem</span>
                                </span>
                            </div>
                            <p class="text-gray-600 mb-3 line-clamp-3">{{ $article->description }}</p>
                            @if($article->read_more_link)
                            <a href="{{ route('news.read_more', $article->id) }}"
                               class="inline-flex items-center text-primary hover:underline text-sm read-more-btn"
                               data-link="{{ route('news.read_more', $article->id) }}"
                               data-article-id="{{ $article->id }}">
                                Đọc tiếp <i class="ri-arrow-right-line ml-1"></i>
                            </a>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
                <!-- Phân trang -->
                <div class="mt-8">
                    {{ $articles->links() }}
                </div>
            </div>

            <!-- Video nổi bật -->
            <div class="mb-12">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Video nổi bật</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($videos as $video)
                    <div class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-all duration-300" data-video-id="{{ $video->id }}">
                        <div class="relative h-48">
                            <img src="{{ $video->thumbnail }}" alt="Video bóng đá" class="w-full h-full object-cover object-top">
                            <button type="button"
                                class="absolute inset-0 flex items-center justify-center w-full h-full focus:outline-none play-video-btn"
                                data-video-link="{{ $video->link }}">
                                <div class="w-12 h-12 rounded-full bg-white bg-opacity-80 flex items-center justify-center">
                                    <i class="ri-play-fill ri-xl text-primary"></i>
                                </div>
                            </button>
                            <div class="absolute bottom-2 right-2 bg-black bg-opacity-70 text-white px-2 py-1 rounded text-xs">
                                {{ $video->duration }}
                            </div>
                        </div>
                        <div class="p-3">
                            <h3 class="text-base font-bold text-gray-800">
                                <a href="{{ $video->link }}" target="_blank">{{ $video->title }}</a>
                            </h3>
                            <div class="flex items-center text-gray-500 text-sm mt-2">
                                <span class="flex items-center">
                                    <i class="ri-calendar-line mr-1"></i>
                                    {{ \Carbon\Carbon::parse($video->date_posted)->format('d/m/Y') }}
                                </span>
                                <span class="mx-2">•</span>
                                <span class="flex items-center">
                                    <i class="ri-eye-line mr-1"></i>
                                    <span class="video-views-count">{{ number_format($video->views) }}</span>
                                </span>
                            </div>
                            @if(auth()->check() && auth()->user()->is_admin)
                            <div class="mt-2 flex gap-2">
                                <a href="{{ route('videos.edit', $video->id) }}" class="text-blue-600 hover:underline text-xs">Sửa</a>
                                <form action="{{ route('videos.destroy', $video->id) }}" method="POST" onsubmit="return confirm('Bạn chắc chắn muốn xoá?')" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline text-xs">Xoá</button>
                                </form>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
                @if(auth()->check() && auth()->user()->is_admin)
                <div class="mt-4">
                    <a href="{{ route('videos.create') }}" class="px-4 py-2 bg-primary text-white rounded hover:bg-blue-700">Thêm video mới</a>
                </div>
                @endif
            </div>

            <!-- Modal popup đọc tiếp -->
            <div id="readMoreModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
                <div class="bg-white rounded-lg shadow-lg max-w-2xl w-full relative">
                    <button id="closeModalBtn" class="absolute top-2 right-2 text-gray-500 hover:text-red-500 text-2xl">&times;</button>
                    <iframe id="readMoreIframe" src="" class="w-full h-[500px] rounded-b-lg" frameborder="0"></iframe>
                </div>
            </div>

            <!-- Modal xem video -->
            <div id="videoModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
                <div class="bg-white rounded-lg shadow-lg max-w-2xl w-full relative">
                    <button id="closeVideoModalBtn" class="absolute top-2 right-2 text-gray-500 hover:text-red-500 text-2xl">&times;</button>
                    <div class="aspect-w-16 aspect-h-9">
                        <iframe id="videoIframe" src="" class="w-full h-96 rounded-b-lg" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </main>
        <script src="{{ asset('js/news-popup.js') }}"></script>
        <script src="{{ asset('js/video-popup.js') }}"></script>
    </body>
</x-app-layout>

</html>