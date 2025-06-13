<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function product()
    {
        return $this->belongsToMany(Product::class)
            ->withTimestamps()
            ->withPivot(['current_qty','updated_at']);
    }

    public function transactionNote()
    {
        return $this->belongsToMany(TransactionNote::class,'transactions')
            ->withTimestamps()
            ->withPivot(['product_id','qty','transaction_notes_id','purchase_unit_price','sale_unit_price','total','notes']);
    }
}
