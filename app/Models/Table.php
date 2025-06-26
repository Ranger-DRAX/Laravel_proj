<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $fillable = [
        'restaurant_id',
        'table_no',
        'seating_capacity',
        'layout_position',
        'layout_x',
        'layout_y',
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
