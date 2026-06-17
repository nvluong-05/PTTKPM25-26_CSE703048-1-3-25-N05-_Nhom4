
@extends('layouts.admin')
@section('content')
<h2>Thống kê tin tức</h2>
<ul>
    <li>Tổng số bài viết: {{ $total }}</li>
    <li>Tổng lượt xem: {{ $totalViews }}</li>
</ul>

<canvas id="topArticlesChart" width="600" height="300"></canvas>

@php
    $topArticles = \App\Models\Article::orderByDesc('views')->take(5)->get();
    $labels = $topArticles->pluck('title');
    $views = $topArticles->pluck('views');
@endphp

<script>
    window.topArticlesLabels = {!! json_encode($labels) !!};
    window.topArticlesViews = {!! json_encode($views) !!};
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('js/admin-articles-stats.js') }}"></script>
@endsection