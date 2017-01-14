<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        //company types
        Schema::create('company_types', function(Blueprint $table){
            $table->increments('id');
            $table->string('title', 50)->unique();
            $table->text('description')->nullable();
            $table->integer('child_of')->default(0); //multi level types, child_of id is his parent id.
            $table->timestamps();
            $table->softDeletes();
        });

        //People Table
        Schema::create('company', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->text('description');

            $table->integer('company_type')->unsigned()->nullable();

            $table->timestamps();
            $table->softDeletes();

            //Relationships
            $table->foreign('company_type')
                ->references('id')->on('company_types');
        });

        //Company other locations
        Schema::create('company_locations', function(Blueprint $table){
            $table->increments('id');
            $table->integer('company_id')->unsigned();
            $table->string('name', 255);
            $table->text('description');

            $table->string('email', 255)->nullable();
            $table->string('sec_email', 255)->nullable();

            $table->string('registration_no', 100);
            $table->string('country');
            $table->string('state', 50)->nullable();
            $table->integer('city_id')->unsigned()->nullable();
            $table->text('address')->nullable();
            $table->string('zipcode', 50)->nullable();
            $table->string('phone_country_code', 14)->nullable();
            $table->string('phone_area_code', 14)->nullable();
            $table->string('phone', 50)->nullable();
            $table->boolean('is_origin')->default(false); //Origin means, company head office
            $table->boolean('is_branch')->default(true);

            $table->timestamps();
            $table->softDeletes();

            //Relationships
            $table->foreign('company_id')
                ->references('id')->on('company');
            $table->foreign('country')
                ->references('short_code')->on('geo_countries');
            $table->foreign('city_id')
                ->references('id')->on('geo_cities')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_locations');
        Schema::dropIfExists('company');
        Schema::dropIfExists('company_types');

    }
}
