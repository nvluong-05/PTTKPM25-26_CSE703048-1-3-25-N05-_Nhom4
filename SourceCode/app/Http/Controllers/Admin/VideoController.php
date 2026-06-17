<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Video;

class VideoController extends Controller
{
    // Hiển thị danh sách video
    public function index()
    {
        $videos = Video::orderByDesc('date_posted')->paginate(10);
        return view('admin.videos.index', compact('videos'));
    }

    // Hiển thị form thêm mới
    public function create()
    {
        return view('admin.videos.create');
    }

    // Lưu video mới
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'thumbnail' => 'required|max:255',
            'link' => 'required|max:255',
            'date_posted' => 'required|date',
            'duration' => 'required|max:20',
        ]);
        Video::create($request->all());
        return redirect()->route('admin.videos.index')->with('success', 'Đã thêm video!');
    }

    // Hiển thị form sửa
    public function edit($id)
    {
        $video = Video::findOrFail($id);
        return view('admin.videos.edit', compact('video'));
    }

    // Cập nhật video
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'thumbnail' => 'required|max:255',
            'link' => 'required|max:255',
            'date_posted' => 'required|date',
            'duration' => 'required|max:20',
        ]);
        $video = Video::findOrFail($id);
        $video->update($request->all());
        return redirect()->route('admin.videos.index')->with('success', 'Đã cập nhật video!');
    }

    // Xoá video
    public function destroy($id)
    {
        $video = Video::findOrFail($id);
        $video->delete();
        return redirect()->route('admin.videos.index')->with('success', 'Đã xoá video!');
    }
}