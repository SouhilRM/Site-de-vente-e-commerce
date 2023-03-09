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

            $table->integer('brand_id')->nullable();
            $table->integer('categorie_id')->nullable();
            $table->integer('sub_categorie_id')->nullable();
            $table->integer('sub_sub_categorie_id')->nullable();

            $table->string('product_name_en')->nullable();
            $table->string('product_name_fr')->nullable();
            $table->string('product_slug_en')->nullable();
            $table->string('product_slug_fr')->nullable();
            $table->string('product_code')->nullable();
            $table->string('product_qty')->nullable();
            $table->string('product_tags_en')->nullable();
            $table->string('product_tags_fr')->nullable();
            $table->string('product_size_en')->nullable();
            $table->string('product_size_fr')->nullable();
            $table->string('product_color_en')->nullable();
            $table->string('product_color_fr')->nullable();
            $table->string('selling_price')->nullable();
            $table->string('discount_price')->nullable();
            $table->string('short_descp_en')->nullable();
            $table->string('short_descp_fr')->nullable();
            $table->text('long_descp_en')->nullable();
            $table->text('long_descp_fr')->nullable();
            $table->string('product_thambnail')->nullable();
            $table->integer('hot_deals')->nullable();
            $table->integer('featured')->nullable();
            $table->integer('special_offer')->nullable();
            $table->integer('special_deals')->nullable();
            $table->integer('status')->default(0);
            $table->integer('digital_file')->default(0);
            $table->timestamps();
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
