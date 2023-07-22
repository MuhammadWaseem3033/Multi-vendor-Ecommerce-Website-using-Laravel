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
            $table->string('product_name');
            $table->bigInteger('section_id')->constrained();
            $table->bigInteger('category_id')->constrained();
            $table->bigInteger('vendor_id')->constrained();
            $table->bigInteger('admin_id')->constrained();
            $table->bigInteger('brand_id')->constrained();
            $table->string('admin_type');
            $table->string('product_code');
            $table->string('product_color');
            $table->string('product_price');
            $table->string('product_discount')->nullable();
            $table->string('product_weight')->nullable();
            $table->string('product_image')->nullable();
            $table->string('product_vedio')->nullable();
            $table->string('discription')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_discription')->nullable();
            $table->string('meta_kaywords')->nullable();
            $table->enum('is_featured',['No','Yes'])->default('Yes');
            $table->tinyInteger('status')->default(1);
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
