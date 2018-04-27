<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubDistrictsTable extends Migration
{
    public function up()
    {
        Schema::create('sub_districts', function (Blueprint $table) {
            $table->increments('id');            
            $table->string('name');            
            $table->integer('value')->nullable();
            $table->unsignedInteger('city_id')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();            
            $table->timestamps();                     
            $table->timestamp('deleted_at')->nullable();
        });
        
        Schema::table('sub_districts', function(Blueprint $table){
            $table->foreign('city_id')
                ->references('id')
                ->on('cities')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sub_districts');
    }
}
