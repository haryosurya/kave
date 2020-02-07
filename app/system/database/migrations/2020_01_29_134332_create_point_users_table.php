<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePointUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('point_users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('point_user_id', TRUE);
            $table->integer('customer_id');
            $table->integer('point');
            $table->index(['point_user_id', 'customer_id']);
        });
    }
    

    /**
     * Reverse the migrations.
     *
     * @re6turn void
     */
    public function down()
    {
        Schema::dropIfExists('point_users');
    }
}
