<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Tiêu đề video
            $table->string('link')->nullable();
            $table->string('thumbnail')->nullable(); // Ảnh đại diện video
            $table->string('duration')->nullable(); // Thời lượng (ví dụ: 03:45)
            $table->date('date_posted')->nullable(); // Ngày đăng
            $table->integer('views')->default(0); // Lượt xem
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos');
    }
};
