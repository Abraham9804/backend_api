<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = ['name','description','subject','action'];
    public function role()
    {
        return $this->belongsToMany(Role::class);
    }
}
