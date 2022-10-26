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
        Schema::create('sub_sub_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('categorie_id')->constrained()->cascadeOnDelete();
            $table->foreignId('sub_categorie_id')->constrained()->cascadeOnDelete();
            $table->string('categorie_name_en')->nullable();
            $table->string('categorie_name_fr')->nullable();
            $table->string('categorie_slug_en')->nullable();
            $table->string('categorie_slug_fr')->nullable();
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
        Schema::dropIfExists('sub_sub_categories');
    }
};
