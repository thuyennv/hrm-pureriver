<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateWorkdaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('workdays', function (Blueprint $table) {
            $table->tinyInteger('type')->default(0)->index(); // Xác định bản ghi là checkin đầu ngày (0) hay cuối ngày (1)
            $table->float('menhours')->default(0); // Xác định thời gian làm việc dựa trên hiệu số của lượt checkin: cuối - đầu - 1.5 giờ nghỉ.
            $table->float('extrahours')->default(0); // Xác định thời gian làm thêm.
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('workdays', function (Blueprint $table) {
            //
        });
    }
}
