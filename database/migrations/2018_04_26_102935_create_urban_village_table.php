<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUrbanVillageTable extends Migration
{
    public function up()
    {
        Schema::create('urban_villages', function (Blueprint $table) {
            $table->increments('id');            
            $table->string('name');            
            $table->string('postcode');            
            $table->integer('value')->nullable();
            $table->unsignedInteger('sub_districts_id')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();            
            $table->timestamps();                     
            $table->timestamp('deleted_at')->nullable();
        });
        
        Schema::table('urban_villages', function(Blueprint $table){
            $table->foreign('sub_districts_id')
                ->references('id')
                ->on('sub_districts')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('urban_villages');
    }
}
