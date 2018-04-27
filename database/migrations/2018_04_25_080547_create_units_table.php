<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('units', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type');
            $table->string('name');            
            $table->string('code');
            $table->string('short_name')->nullable();
            $table->string('address')->nullable();
            $table->integer('active')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();            
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('units');
    }
}
