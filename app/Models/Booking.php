<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'restaurant_id',
        'table_id',
        'date',
        'time_slot',
        'seating_capacity',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
    public function table()
    {
        return $this->belongsTo(Table::class);
    }
}
