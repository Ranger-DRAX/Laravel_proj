<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $fillable = [
        'name',
        'description',
        'location',
        'contact_info',
    ];

    public function tables()
    {
        return $this->hasMany(Table::class);
    }

    public function branches()
    {
        return $this->hasMany(Branch::class);
    }
}
