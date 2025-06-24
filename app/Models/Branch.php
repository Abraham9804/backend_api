<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = ['name','address','phone','city'];
    public function user()
    {
        return $this->belongsToMany(User::class);
    }

    public function warehouse()
    {
        return $this->hasMany(Warehouse::class);
    }
}
