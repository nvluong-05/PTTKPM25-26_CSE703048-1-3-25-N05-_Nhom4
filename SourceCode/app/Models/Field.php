<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use HasFactory;

    protected $table = 'fields';

    protected $fillable = [
        'name',
        'type',
        'address',
        'description',
        'price_per_hour',
        'image',
        'active',
    ];

    // Nếu muốn liên kết với booking
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'field_id');
    }
}
