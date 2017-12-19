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
            $table->integer('studentType');
            $table->text('considerations');
            $table->integer('visitors');
            $table->integer('attended');
            $table->integer('startTerm');

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
