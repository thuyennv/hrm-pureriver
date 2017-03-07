<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->tinyInteger('type')->index()->nullable(); // Loại nhân viên: 0: thử việc, 1: chính thức, 2: thực tập...
            $table->dateTime('trial_time')->nullable();
            $table->dateTime('offical_time')->nullable();
            $table->dateTime('contract_start_time')->nullable(); // Bắt đầu ký hợp đồng
            $table->dateTime('contract_end_time')->nullable(); // Hết hạn hợp đồng
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
