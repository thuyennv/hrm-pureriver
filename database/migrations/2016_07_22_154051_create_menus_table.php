<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('menus', function(Blueprint $table) {
        $table->increments('id');
        $table->integer('parent_id')->nullable()->index();
        $table->integer('lft')->nullable()->index();
        $table->integer('rgt')->nullable()->index();
        $table->integer('depth')->nullable();

        // Add needed columns here (f.ex: name, slug, path, etc.)
        $table->string('name', 255);
        // 0: TOP | 1: LEFT | 2: RIGHT | 3: BOTTOM
        $table->integer('position')->nullable()->index(); // Vị trí hiển thị trên layout
        $table->integer('page_id')->default(0)->index();
        $table->integer('order')->default(0)->index();
        $table->tinyInteger('active')->default(1)->index();
        $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::drop('menus');
  }

}
