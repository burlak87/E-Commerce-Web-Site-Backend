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
        Schema::create('my_orders', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['notgondone', 'notdone', 'done']);
            $table->string('number');
            $table->date('date');
            $table->date('estimated_date');
            $table->string('payment_method');
            $table->foreign('order_details_id')->references('id')->on('order_details')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('my_orders');
    }
};
