<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommunesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function id($column = 'id_com'){
        return $this->increments($column);
    }

    public function up()
    {
        Schema::create('communes', function (Blueprint $table) {
            $table->id();
            $table->integer('id_reg')->length(10)->unsigned;
            $table->string('description', 45);
            $table->foreign('id_reg')
                ->references('id_reg')
                ->on('regions')
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
        Schema::dropIfExists('communes');
    }
}
