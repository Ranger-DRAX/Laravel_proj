<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Restaurant extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'description', 'owner_id',
    ];

    public function branches()
    {
        return $this->hasMany(Branch::class);
    }
}
