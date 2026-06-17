<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Video;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    

public function index()
{
    // Lấy từ khóa tìm kiếm nếu có
    $search = request('search');

    // Lấy tất cả bài viết, sắp xếp theo lượt xem giảm dần
    $allArticles = Article::orderByDesc('views');

    // Nếu có từ khóa tìm kiếm, lọc theo tiêu đề hoặc mô tả
    if ($search) {
        $allArticles = $allArticles->where(function($query) use ($search) {
            $query->where('title', 'like', "%$search%")
                  ->orWhere('description', 'like', "%$search%");
        });
    }

    $allArticles = $allArticles->get();

    // Lấy 2 bài nổi bật nhất
    $featured = $allArticles->take(2);

    // Các bài còn lại, phân trang (6 bài mỗi trang)
    $articles = $allArticles->slice(2)->values();
    $perPage = 6;
    $currentPage = request('page', 1);
    $pagedArticles = new \Illuminate\Pagination\LengthAwarePaginator(
        $articles->forPage($currentPage, $perPage),
        $articles->count(),
        $perPage,
        $currentPage,
        ['path' => request()->url(), 'query' => request()->query()]
    );

    // Lấy video và phân trang
    $videos = Video::orderByDesc('date_posted')->paginate(4);

    return view('profile.news.news', [
        'featured' => $featured,
        'articles' => $pagedArticles,
        'videos' => $videos,
    ]);
}

public function search(Request $request)
{
    $search = $request->input('search');
    $articles = Article::query();

    if ($search) {
        $articles->where('title', 'like', "%$search%")
                 ->orWhere('description', 'like', "%$search%");
    }

    $articles = $articles->paginate(9);

    return view('profile.news.search_results', [
        'articles' => $articles,
        'search' => $search,
    ]);
}

}
