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
        Schema::create('transaction_notes', function (Blueprint $table) {
            $table->id();
            $table->string('note_code',100)->unique();
            $table->date('issue_date');
            $table->string('note_type',20);
            $table->foreignId('business_entity_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->decimal('subtotal',10,2)->default(0);
            $table->decimal('taxes',10,2)->default(0);
            $table->decimal('total_discount',10,2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_notes');
    }
};
