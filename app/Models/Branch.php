<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = [
        'restaurant_id',
        'name',
        'address',
        'contact_info',
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function tables()
    {
        return $this->hasMany(Table::class);
    }
}
