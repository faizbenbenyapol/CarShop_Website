<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->text('product_detail');
            $table->decimal('price', 10, 2);
            $table->string('picture')->nullable();
            $table->foreignId('category_id')->nullable()->constrained('categories');
            $table->foreignId('brand_id')->nullable()->constrained('brands');
            $table->string('model_year')->nullable();
            $table->string('fuel_type')->nullable();
            $table->string('transmission')->nullable();
            $table->integer('mileage')->nullable();
            $table->enum('status', ['available', 'sold', 'reserved'])->default('available');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cars');
    }
};