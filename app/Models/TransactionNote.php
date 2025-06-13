<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionNote extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function businessEntity()
    {
        return $this->belongsTo(BusinessEntity::class);
    }

    public function warehouse()
    {
        return $this->belongsToMany(Warehouse::class, 'transactions')
        ->withTimestamps()
        ->withPivot(['product_id','qty','transaction_notes_id','purchase_unit_price','sale_unit_price','total','notes']);
    }
}
