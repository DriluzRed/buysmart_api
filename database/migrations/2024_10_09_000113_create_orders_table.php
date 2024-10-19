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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained();
            $table->enum('status', ['pending', 'processed', 'shipped', 'delivered']);
            $table->foreignId('payment_method_id')->constrained();
            $table->enum('payment_status', ['pending', 'paid', 'failed', 'canceled']);
            $table->foreignId('address_id')->constrained();
            $table->decimal('subtotal', 10, 2);
            $table->decimal('additional_charges', 10, 2)->default(0);
            $table->decimal('total', 10, 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
