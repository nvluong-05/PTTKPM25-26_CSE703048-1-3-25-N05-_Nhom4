<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;

class VideoController extends Controller
{
    public function create()
    {
        return view('videos.create');
    }

    public function store(Request $request)
    {
        // Validate & save video
        Video::create($request->all());
        return redirect()->back()->with('success', 'Thêm video thành công!');
    }

    public function edit($id)
    {
        $video = Video::findOrFail($id);
        return view('videos.edit', compact('video'));
    }

    public function update(Request $request, $id)
    {
        $video = Video::findOrFail($id);
        $video->update($request->all());
        return redirect()->back()->with('success', 'Cập nhật video thành công!');
    }

    public function destroy($id)
    {
        $video = Video::findOrFail($id);
        $video->delete();
        return redirect()->back()->with('success', 'Xoá video thành công!');
    }

    // Hàm tăng lượt xem video qua AJAX
    public function increaseView($id)
    {
        $video = Video::findOrFail($id);
        $video->increment('views');
        return response()->json(['views' => $video->views]);
    }
}