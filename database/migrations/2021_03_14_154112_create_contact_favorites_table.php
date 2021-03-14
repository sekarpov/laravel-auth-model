<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactFavoritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_favorites', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable(false);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->unsignedBigInteger('contact_id')->nullable(false);
            $table->foreign('contact_id')->references('id')->on('contacts')->onDelete('CASCADE');
            $table->primary(['user_id', 'contact_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_favorites');
    }
}
