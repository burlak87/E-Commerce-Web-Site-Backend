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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('lost_name');
            $table->string('role');
            $table->string('phone');
            $table->string('email');
            $table->string('password_hash');
            $table->unsignedBigInteger('wishlist_id');
            $table->unsignedBigInteger('my_order_id');
            $table->unsignedBigInteger('address_id');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('wishlist_id')->references('id')->on('wishlists')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('my_order_id')->references('id')->on('my_orders')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('address_id')->references('id')->on('addresses')
                ->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
