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
            $table->bigIncrements('id');
            $table->string('full_name')->index();
            $table->string('email')->index()->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->smallInteger('department_id')->index()->nullable();
            $table->timestamp('hiring_time')->index()->nullable();
            $table->decimal('salary',15)->index()->nullable();
            $table->bigInteger('parent_id')->index()->nullable();
            $table->tinyInteger('deep')->index()->nullable();
            $table->tinyInteger('position')->index()->nullable()->default(0);
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
}
