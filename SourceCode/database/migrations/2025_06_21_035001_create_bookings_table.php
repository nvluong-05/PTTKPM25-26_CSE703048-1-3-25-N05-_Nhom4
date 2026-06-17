<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Migration tạo bảng bookings cho chức năng đặt sân
class CreateBookingsTable extends Migration
{
    /**
     * Thực thi migration: tạo bảng bookings
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id(); // Khóa chính tự tăng
            $table->unsignedBigInteger('user_id'); // Khóa ngoại đến bảng users
            $table->unsignedBigInteger('field_id'); // Khóa ngoại đến bảng fields
            $table->date('booking_date'); // Ngày đặt sân
            $table->time('start_time'); // Thời gian bắt đầu
            $table->time('end_time');   // Thời gian kết thúc
            $table->decimal('total_price', 10, 2); // Tổng tiền
            $table->string('status')->default('pending'); // Trạng thái đặt sân
            $table->timestamps(); // created_at và updated_at

            // Khóa ngoại
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('field_id')->references('id')->on('fields')->onDelete('cascade');
        });
    }

    /**
     * Quay lui migration: xóa bảng bookings
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}