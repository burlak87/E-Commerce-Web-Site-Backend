<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('my_orders', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['notgondone', 'notdone', 'done']);
            $table->string('number');
            $table->date('date');
            $table->date('estimated_date');
            $table->string('payment_method');
            $table->unsignedBigInteger('order_details_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->foreign('order_details_id')->references('id')->on('order_details')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('my_orders');
    }
};
