<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessEntity extends Model
{
    public function contact()
    {
        return $this->hasMany(Contact::class);
    }

    public function transactionNote()
    {
        return $this->hasMany(TransactionNote::class);
    }
}
