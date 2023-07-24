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
            $table->string('fname',100);
            $table->string('lname',100);
            $table->string('gender',50);
            $table->string('phone',15);
            $table->string('father_name',100);
            $table->text('permanent_address');
            $table->text('temporary_address')->nullable();
            $table->date('dob');
            $table->date('joining_date');
            $table->date('confirmation_date')->nullable();
            $table->string('marital_status',50)->nullable();
            $table->integer('department_id')->nullable();
            $table->integer('designation')->nullable();
            $table->text('skills')->nullable();
            $table->text('employment_type')->nullable();
            // $table->string('email')->unique();
            // $table->timestamp('email_verified_at')->nullable();
            $table->string('username',50);
            $table->string('password');
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
}
