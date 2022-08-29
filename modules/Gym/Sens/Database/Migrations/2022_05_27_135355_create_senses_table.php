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
        Schema::create('senses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable()->unsigned();
            $table->unsignedBigInteger('price_group_id')->unsigned();
            $table->unsignedBigInteger('service_id')->unsigned();
            $table->string('volume')->default(1);
            $table->json('day');
            $table->time('start');
            $table->time('end');
            $table->date('start_at');
            $table->date('expire_at');
            $table->boolean('is_enabled')->default('0');
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
        Schema::dropIfExists('senses');
    }
};
