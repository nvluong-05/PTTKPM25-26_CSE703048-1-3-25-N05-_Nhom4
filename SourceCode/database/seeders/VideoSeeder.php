<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Video;

class VideoSeeder extends Seeder
{
    public function run()
    {
        $videos = [
            [
                'title' => 'Top 5 bàn thắng đẹp nhất vòng 15 V-League 2025',
                'link' => 'https://www.youtube.com/watch?v=DMaHcJ9aM9I',
                'thumbnail' => 'https://vnn-imgs-f.vgcloud.vn/2020/11/04/20/hanoi-quanghai.jpg',
                'duration' => '03:45',
                'date_posted' => '2025-06-10',
                'views' => 1200,
            ],
            [
                'title' => 'Hướng dẫn rê bóng như Quang Hải',
                'link' => 'https://www.youtube.com/watch?v=1HIg1-uNfjs',
                'thumbnail' => 'https://manayi.vn/wp-content/uploads/cac-bai-tap-bong-da-chuyen-nghiep.jpg',
                'duration' => '06:52',
                'date_posted' => '2025-06-08',
                'views' => 1500,
            ],
            [
                'title' => 'Tổng hợp trận đấu: PSG 5-0 INTER MILAN',
                'link' => 'https://www.youtube.com/watch?v=tU99_CZthZo',
                'thumbnail' => 'https://d4f7y6nbupj5z.cloudfront.net/wp-content/uploads/2025/05/PSG-Champs-1-1024x734.jpeg',
                'duration' => '04:52',
                'date_posted' => '2025-06-07',
                'views' => 2300,
            ],
        ];

        foreach ($videos as $video) {
            Video::updateOrCreate(
                ['title' => $video['title']],
                $video
            );
        }
    }
}
