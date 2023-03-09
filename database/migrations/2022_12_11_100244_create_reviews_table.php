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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();

            $table->text('comment');
            $table->string('summary');
            $table->integer('rating')->default(0);

            //relation OneToMany meme principe que les commentaires
            $table->unSignedBigInteger('product_id')->unsigned();
            $table->foreign('product_id')
                    ->references('id')->on('products')
                    ->onDelete('cascade');
            //$table->foreignId('product_id')->constrained()->onDelete('cascade');  marche aussi

            $table->unSignedBigInteger('user_id')->unsigned();
            $table->foreign('user_id')
                    ->references('id')->on('users')
                    ->onDelete('cascade');
            //$table->foreignId('user_id')->constrained()->onDelete('cascade');  marche aussi

            $table->string('status')->default(0);
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
        Schema::dropIfExists('reviews');
    }
};
