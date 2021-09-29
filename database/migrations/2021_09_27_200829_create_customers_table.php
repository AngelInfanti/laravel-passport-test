<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function id($column = 'dni'){
        return $this->string($column, 45)->unique();
    }
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->integer('id_reg', 10)->unsigned;
            $table->integer('id_com', 10)->unsigned;
            $table->string('email', 120)->unique();
            $table->string('name', 45);
            $table->string('last_name', 45);
            $table->string('address', 255);
            $table->dateTime('date_reg');
            $table->foreign('id_reg')
                ->references('id_reg')
                ->on('communes')
                ->onDelete('cascade');
            $table->foreign('id_com')
                ->references('id_com')
                ->on('communes')
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
        Schema::dropIfExists('customers');
    }
}
