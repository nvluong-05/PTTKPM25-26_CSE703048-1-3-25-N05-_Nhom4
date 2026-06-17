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
        Schema::create('fields', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Tên sân
            $table->string('type')->nullable(); // Loại sân (5 người, 7 người, futsal...)
            $table->string('address')->nullable(); // Địa chỉ sân
            $table->text('description')->nullable(); // Mô tả thêm
            $table->decimal('price_per_hour', 10, 2)->nullable(); // Giá thuê/giờ
            $table->string('image')->nullable(); // Ảnh sân
            $table->boolean('active')->default(true); // Trạng thái hoạt động
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
        Schema::dropIfExists('fields');
    }
};