<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->id('user_id'); // Primary Key
            $table->unsignedBigInteger('role_id'); 
            $table->string('nama', 100)->nullable();
            $table->string('email', 100)->unique();
            $table->string('nipn_nim', 50)->nullable();
            $table->string('kontak', 15)->nullable();
            $table->string('password');
            $table->timestamps(); 

            // Foreign Key Constraint
            $table->foreign('role_id')->references('role_id')->on('role')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
    }
}
