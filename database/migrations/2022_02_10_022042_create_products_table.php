<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->text("description");
            $table->decimal("price",20,2);
            $table->text("image_path");
            $table->foreignId("user_id")->constrained()->onDelete('cascade');
            $table->foreignId("product_category_id")->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->index(['name']);
            $table->index(['price']);
            $table->index(['product_category_id']);
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
