<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    // Khai báo đúng tên bảng
    protected $table = 'bookings';

    // Các trường cho phép gán dữ liệu hàng loạt
    protected $fillable = [
        'user_id',
        'field_id',
        'booking_date',
        'start_time',
        'end_time',
        'total_price',
        'status',
    ];

    // Quan hệ với User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Quan hệ với Field
    public function field()
    {
        return $this->belongsTo(Field::class, 'field_id');
    }
}