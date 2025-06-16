<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{   
    protected $fillable = ["name","description", "bar_code", "umc", "manufacturer_name", "category_id", "sale_price", "min_stock", "url_image", "active"];

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
