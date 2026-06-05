<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('orders')) {
            Schema::create('orders', function (Blueprint $table) {
                $table->id();
                $table->string('order_number')->unique();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->string('user_name');
                $table->string('user_email');
                $table->string('user_phone')->nullable();
                $table->text('shipping_address')->nullable();
                $table->decimal('subtotal', 10, 2);
                $table->decimal('total', 10, 2);
                $table->string('payment_method')->default('cod');
                $table->string('payment_status')->default('pending');
                $table->string('order_status')->default('pending');
                $table->text('notes')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};