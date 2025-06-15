<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function warehouse()
    {
        return $this->belongsToMany(Warehouse::class)
        ->withTimestamps()
        ->withPivot(["current_qty"]);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
