<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_points', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('menu_point_id', TRUE);
            $table->integer('menu_id')->default(0);
            $table->decimal('point_price', 15, 4)->nullable();
            $table->boolean('point_status');
            $table->unique(['menu_point_id', 'menu_id']);
        });
    }
  
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_points');
    }
}
