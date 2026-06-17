<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    // Hiển thị danh sách bài viết
    public function index()
    {
        $articles = Article::orderByDesc('date_posted')->paginate(10);
        return view('admin.articles.index', compact('articles'));
    }

    // Hiển thị form thêm mới
    public function create()
    {
        return view('admin.articles.create');
    }

    // Lưu bài viết mới
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'category' => 'nullable|max:100',
            'date_posted' => 'required|date',
            'image_url' => 'nullable|max:255',
            'read_more_link' => 'nullable|max:255',
        ]);
        Article::create($request->all());
        return redirect()->route('admin.articles.index')->with('success', 'Đã thêm bài viết!');
    }

    // Xem chi tiết bài viết
    public function show($id)
    {
        $article = Article::findOrFail($id);
        return view('admin.articles.show', compact('article'));
    }

    // Hiển thị form sửa
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('admin.articles.edit', compact('article'));
    }

    // Cập nhật bài viết
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'category' => 'nullable|max:100',
            'date_posted' => 'required|date',
            'image_url' => 'nullable|max:255',
            'read_more_link' => 'nullable|max:255',
        ]);
        $article = Article::findOrFail($id);
        $article->update($request->all());
        return redirect()->route('admin.articles.index')->with('success', 'Đã cập nhật bài viết!');
    }

    // Xoá bài viết
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();
        return redirect()->route('admin.articles.index')->with('success', 'Đã xoá bài viết!');
    }

    // Thống kê bài viết
    public function stats()
    {
        $total = \App\Models\Article::count();
        $totalViews = \App\Models\Article::sum('views');
        $topArticle = \App\Models\Article::orderByDesc('views')->first();
        return view('admin.articles.stats', compact('total', 'totalViews', 'topArticle'));
    }
}
