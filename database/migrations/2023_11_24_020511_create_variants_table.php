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
        Schema::create('variants', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('Product_id')->constrained()->references('id')->on('products')->onDelete("cascade");
            $table->foreignId('Option_id')->constrained()->references('id')->on('options')->onDelete("cascade");
            $table->foreignId('option_values_id')->constrained()->references('id')->on('option__values')->onDelete("cascade");
            $table->integer('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variants');
    }
};
