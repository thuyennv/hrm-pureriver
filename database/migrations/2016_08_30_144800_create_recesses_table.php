<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recesses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id')->index();
            $table->datetime('recessed_at');
            $table->text('reason');
            $table->tinyInteger('status')->default(0)->index(); // 0: pending 1: confirmed 2: denied 3: cancel
            $table->integer('manager_id')->index();
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
        Schema::drop('recesses');
    }
}
