<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone')->nullable();

            $table->boolean('is_active')->default(true);
            $table->boolean('is_admin')->default(false);
            $table->boolean('is_blocked')->default(false);
            $table->boolean('is_new')->default(true);

            $table->string('google_id')->nullable();
            $table->string('tiktok_id')->nullable();
            $table->string('x_id')->nullable();
            $table->string('fb_id')->nullable();
            $table->string('ig_id')->nullable();

            $table->foreignId('brand_id')->default(1);
            $table->timestamp('last_login')->nullable();
            $table->timestamp('last_logout')->nullable();

            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('address')->nullable();
            $table->string('birth_place')->nullable();
            $table->string('birth_date', 10)->nullable()->default('2000-01-01');
            $table->string('bio')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_profiles');
        Schema::dropIfExists('users');
    }
}
