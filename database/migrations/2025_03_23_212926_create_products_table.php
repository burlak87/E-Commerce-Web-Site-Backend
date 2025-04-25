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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string('price');
            $table->string('stock_quantity');
            $table->string('image_url');
            $table->enum('color', ['red', 'grey', 'black', 'white', 'pink', 'orange', 'brown']);
            $table->enum('size', ['XXS', 'XL', 'XS', 'S', 'M', 'L', 'XXL', '3XL', '4XL']);
            $table->enum('category', ['men', 'women', 'joggers']);
            $table->enum('type_product', ['Tops', 'Printed T-shirts', 'Plain T-shirts', 
                'Kurti', 'Boxers', 'Full sleeve T-shirts', 'Joggers', 'Payjamas', 'Jeans']);
            $table->enum('dress_style', ['Classic', 'Casual', 'Business', 'Sport', 'Elegant', 'Formal(evening)']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
