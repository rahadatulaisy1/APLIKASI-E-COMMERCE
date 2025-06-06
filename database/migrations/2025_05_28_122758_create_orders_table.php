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
            $table->engine = 'InnoDB';
            $table->string('order_id')->primary();
            $table->string('customer_id');
            $table->date('order_date');
            $table->decimal('total_amount', 10, 2);
            $table->string('status');
            $table->timestamps();

            $table->index('customer_id');
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