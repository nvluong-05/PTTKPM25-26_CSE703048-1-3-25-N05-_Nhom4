<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\User;
use App\Models\Article;
use App\Models\Video;

class newController extends Controller
{
    //
    public function form(){
        $news = News::all();
        $users = User::all();
        return view('new.form', ['news' => $news, 'users' => $users]);
    }
    public function login(Request $request){ //Phan dang nhap
        $credentials = $request->only('email', 'password');
        if (auth()->attempt($credentials)) {
            return redirect()->route('new.form')->with('success', 'Login successful');
        } else {
            return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
        }
    }
    public function infor(){
        return view('new.infor');
    }
    public function booking(){
        return view('partials.booking');
    }
    public function readMore($id)
    {
        $article = Article::findOrFail($id);
        $article->increment('views');
        return redirect($article->read_more_link);
    }
    public function increaseViews($id)
    {
        $article = Article::findOrFail($id);
        $article->increment('views');
        return response()->json(['views' => $article->views]);
    }
}
