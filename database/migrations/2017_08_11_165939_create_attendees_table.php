<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendees', function (Blueprint $table) {
            $table->increments('id');

            $table->string('firstName');
            $table->string('lastName');
            $table->string('email');
            $table->string('phone');
            $table->integer('studentType')->nullable();
            $table->text('considerations')->nullable();
            $table->integer('visitors');
            $table->integer('attended');
            $table->integer('startTerm')->nullable();
            $table->integer('major');

            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();

            $table->string('highschoolname')->nullable();
            $table->string('highschoolcity')->nullable();
            $table->string('highschoolgpa')->nullable();
            $table->string('highschoolact')->nullable();
            $table->string('highschoolgrade')->nullable();
            $table->string('highschoolearlycollege')->nullable();

            $table->string('collegename')->nullable();
            $table->string('collegecity')->nullable();
            $table->string('collegegpa')->nullable();
            

            $table->boolean('visited');
            $table->boolean('viewable');
            $table->string('token',16)->unique();

            $table->integer('tour_id')->unsigned()->nullable();
            
            $table->timestamps();
            $table->softDeletes();

        });

        
      }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendees');
        
    }
}
