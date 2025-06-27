<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessEntity extends Model
{   
    protected $fillable = ['name','type','rfc','phone','address','email','active'];
    public function contact()
    {
        return $this->hasMany(Contact::class);
    }

    public function transactionNote()
    {
        return $this->hasMany(TransactionNote::class);
    }
}
