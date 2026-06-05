<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('carts')) {
            Schema::create('carts', function (Blueprint $table) {
                $table->id();
                $table->string('session_id');
                $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
                $table->foreignId('product_id')->constrained()->onDelete('cascade');
                $table->string('product_name');
                $table->string('product_image')->nullable();
                $table->decimal('product_price', 10, 2);
                $table->integer('quantity')->default(1);
                $table->timestamps();
                
                $table->index('session_id');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};