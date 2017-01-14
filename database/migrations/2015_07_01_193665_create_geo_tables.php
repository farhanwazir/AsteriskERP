<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeoTables extends Migration
{


    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        //Countries
        Schema::create('geo_countries', function(Blueprint $table){
            $table->increments('id');
            $table->string('short_code', 14)->unique();
            $table->string('name', 50);
            $table->double('map_latitude')->nullable();
            $table->double('map_longitude')->nullable();
            $table->string('ref_id')->nullable();
        });

        DB::statement('alter table geo_countries modify map_latitude DOUBLE (18,11)');
        DB::statement('alter table geo_countries modify map_longitude DOUBLE (18,11)');

        //Regions
        Schema::create('geo_regions', function(Blueprint $table){
            $table->increments('id');
            $table->string('short_code')->nullable();
            $table->string('name', 50);
            $table->integer('country_id')->unsigned();
            $table->double('map_latitude')->nullable();
            $table->double('map_longitude')->nullable();

            $table->foreign('country_id')
                ->references('id')->on('geo_countries')
                ->onDelete('cascade');
        });

        DB::statement('alter table geo_regions modify map_latitude DOUBLE (18,11)');
        DB::statement('alter table geo_regions modify map_longitude DOUBLE (18,11)');

        //cities
        Schema::create('geo_cities', function(Blueprint $table){
            $table->increments('id');
            $table->string('short_code');
            $table->integer('country_id')->nullable();
            $table->integer('region_id')->nullable();
            $table->string('name', 50);
            $table->double('map_latitude')->nullable();
            $table->double('map_longitude')->nullable();

            /*$table->foreign('country_id')
                ->references('id')->on('geo_countries')
                ->onDelete('cascade');*/
        });

        DB::statement('alter table geo_cities modify map_latitude DOUBLE (18,11)');
        DB::statement('alter table geo_cities modify map_longitude DOUBLE (18,11)');


        Schema::create('geo_countries_info', function (Blueprint $table){
            $table->increments('id');
            $table->string('country_name')->nullable();
            $table->string('country_code');
            $table->string('country_code_3')->nullable();
            $table->integer('country_code_num')->nullable();
            $table->string('dial_code')->nullable();
            $table->string('currency_code')->nullable();
            $table->string('currency_name')->nullable();
            $table->integer('currency_code_num')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('geo_cities');
        Schema::dropIfExists('geo_regions');
        Schema::dropIfExists('geo_countries_info');
        Schema::dropIfExists('geo_countries');

    }
}
