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
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('sku')->nullable();
            $table->integer('stock')->default(0);
            $table->text('description')->nullable();
            $table->decimal('cost_price', 15, 2)->nullable();
            $table->decimal('price', 15, 2)->nullable(); // Giá gốc khi chưa có biến thể
            $table->decimal('sale_price', 15, 2)->nullable(); // Giá gốc khi chưa có biến thể
            $table->boolean('is_featured')->default(false);
            $table->unsignedInteger('sold_count')->default(0)->index();
            $table->integer('rank')->default(0)->index();
            $table->softDeletes();
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
