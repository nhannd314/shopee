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
        // Bảng Product Attributes (e.g., Color, Size)
        Schema::create('product_attributes', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., "Color"
            $table->timestamps();
        });

        // Bảng Attribute Values (e.g., Red, Blue, XL, L)
        Schema::create('product_attribute_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_attribute_id')->constrained()->cascadeOnDelete();
            $table->string('value'); // e.g., "Red"
            $table->timestamps();
        });

        // Bảng Product Variants (Các SKU cụ thể)
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->string('sku')->unique(); // Mã định danh sản phẩm
            $table->decimal('price', 15, 2); // Giá riêng cho biến thể này
            $table->decimal('sale_price', 15, 2); // Giá riêng cho biến thể này
            $table->integer('stock')->default(0);
            $table->string('image')->nullable();
            $table->timestamps();
        });

        // Bảng liên kết Biến thể với Giá trị thuộc tính (Pivot table)
        // Ví dụ: Variant A là sự kết hợp của (Color: Red) và (Size: XL)
        Schema::create('variant_attribute_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_variant_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_attribute_value_id')->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_attributes');
        Schema::dropIfExists('product_attribute_values');
        Schema::dropIfExists('product_variants');
        Schema::dropIfExists('variant_attribute_values');
    }
};
