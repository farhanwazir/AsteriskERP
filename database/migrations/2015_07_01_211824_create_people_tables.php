<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeopleTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        //People Contacts Nationality types
        Schema::create('people_nationality_types', function(Blueprint $table){
            $table->increments('id');
            $table->string('title', 50)->unique();
            $table->text('description');
            $table->timestamps();
            $table->softDeletes();
        });

        //People Table
        Schema::create('people', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('spouse_name')->nullable();
            $table->string('sex');

            $table->date('dob')->nullable();
            $table->string('place_of_birth')->nullable();

            $table->string('email', 255)->nullable();

            $table->string('occupation')->nullable();
            /*
             * This is optional, because in the people contact table all these fields are part of it.
             * */
            //This is primary mobile no
            $table->string('country_code', 14)->nullable();
            $table->string('mobile', 50)->nullable();
            $table->text('photo')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('country_code')
                ->references('short_code')->on('geo_countries');
        });


        //People Other Contacts Table
        Schema::create('people_contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('people_id')->unsigned();
            $table->string('title', 50)->nullable()->default('Default');

            $table->string('country_code', 14);

            $table->string('city', 50)->nullable();
            $table->string('province', 50)->nullable();
            $table->string('state', 50)->nullable();
            $table->text('address')->nullable();
            $table->string('zipcode', 50)->nullable();

            $table->integer('nationality_type')->unsigned()->default(1);

            $table->string('phone_area_code', 14)->nullable();
            $table->string('phone', 50)->nullable();

            $table->string('mobile', 50)->nullable();
            $table->string('sec_mobile', 50)->nullable();

            $table->boolean('is_origin')->default(false);
            $table->boolean('is_current')->default(false);
            $table->timestamps();

            //Relationships
            $table->foreign('people_id')
                ->references('id')->on('people')
                ->onDelete('cascade');
            $table->foreign('country_code')
                ->references('short_code')->on('geo_countries');
            $table->foreign('nationality_type')
                ->references('id')->on('people_nationality_types');

        });

        //To alter users table for adding people table foreign key
        Schema::table('users', function(Blueprint $table){
            $table->integer('people_id')->unsigned()->after('id');
            $table->foreign('people_id')
                ->references('id')->on('people')
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

        Schema::dropIfExists('people_contacts');

        Schema::dropIfExists('people_nationality_types');

        Schema::table('users', function(Blueprint $table){
            $table->dropForeign('users_people_id_foreign');
            $table->dropColumn('people_id');
        });

        Schema::dropIfExists('people');

    }
}
