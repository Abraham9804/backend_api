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
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string("first_name",50);
            $table->string("last_name",50);
            $table->date("date_of_birth")->nullable();
            $table->string("gender",10)->nullable();
            $table->string("phone",15)->nullable();
            $table->string("address",100)->nullable();
            $table->string("document_number",50)->nullable();
            $table->string("document_type",20)->nullable();
            $table->string("nationality",50)->nullable();
            $table->foreignId("user_id")->constrained()->onDelete("restrict")->onUpdate("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('people');
    }
};
