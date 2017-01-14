<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeopleExtendEducation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //People Education Type
        Schema::create('people_education_types', function(Blueprint $table){
            $table->increments('id');
            $table->string('title', 255)->unique();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        //People Education
        Schema::create('people_educations', function(Blueprint $table){
            $table->increments('id');
            $table->integer('people_id')->unsigned();
            $table->string('title', 255);
            $table->integer('company_id')->unsigned(); //institute/school/college -- relational field of company table
            $table->string('education_type')->nullable(); //certificate/degree/high school/intermediate/metric
            $table->text('description');
            $table->integer('passing_month');
            $table->integer('passing_year');
            $table->boolean('is_present')->default(false);
            $table->string('grade', 10);
            $table->integer('total_percentage')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('company_id')
                ->references('id')->on('company_locations');
            $table->foreign('education_type')
                ->references('title')->on('people_education_types');
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

        Schema::dropIfExists('people_educations');
        Schema::dropIfExists('people_education_types');
    }
}
