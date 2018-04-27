<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitiesTable extends Migration
{
   /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->increments('id');            
            $table->string('name');            
            $table->integer('value')->nullable();
            $table->unsignedInteger('province_id')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();            
            $table->timestamps();                     
            $table->timestamp('deleted_at')->nullable();
        });
        
        Schema::table('cities', function(Blueprint $table){
            $table->foreign('province_id')
                ->references('id')
                ->on('provinces')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('cities');
    }
}
