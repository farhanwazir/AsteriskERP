<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 200);
            $table->string('slug', 255);
            $table->string('icon_class');
            $table->string('location', 100);
            $table->text('description');
            $table->timestamps();
            $table->softDeletes();
        });


        Schema::create('site_menu_items', function(Blueprint $table){
            $table->increments('id');
            $table->string('title', 200);
            $table->text('description');
            $table->string('icon_class');
            $table->string('method');
            $table->string('action');
            $table->integer('child_of')->default(0);
            $table->integer('menu_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('menu_id')
                ->references('id')->on('site_menus')
                ->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('site_menu_items');
        Schema::drop('site_menus');
    }
}
