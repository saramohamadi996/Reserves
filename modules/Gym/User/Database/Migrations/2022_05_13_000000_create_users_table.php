<?php

use Gym\User\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('staff_id');
            $table->string('name')->nullable()->index();
//            $table->string('username', 50)->unique()->index();
            $table->string('email')->unique()->nullable()->index();
            $table->string('mobile', 14)->unique()->index();
            $table->enum('role',User::$roles)->default('user');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('status', User::$statuses)->default('active');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
