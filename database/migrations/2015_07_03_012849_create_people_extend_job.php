<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeopleExtendJob extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people_jobs', function(Blueprint $table){
            $table->increments('id');
            $table->integer('people_id')->unsigned();
            $table->string('title', 150);
            $table->text('description')->nullable();
            $table->integer('company_id')->unsigned();
            $table->integer('start_month');
            $table->integer('start_year');
            $table->integer('end_month')->nullable();
            $table->integer('end_year')->nullable();
            $table->boolean('is_present')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('people_id')
                ->references('id')->on('people')
                ->onDelete('cascade');
            $table->foreign('company_id')
                ->references('id')->on('company_locations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('people_jobs');
    }
}
