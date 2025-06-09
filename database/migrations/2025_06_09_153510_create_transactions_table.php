<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_notes_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('warehouse_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->integer('qty')->default(1);
            $table->string('transaction_type',30);
            $table->decimal('purchase_unit_price',10,2);
            $table->decimal('sale_unit_price',10,2);
            $table->decimal('total',10,2);
            $table->text('notes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
