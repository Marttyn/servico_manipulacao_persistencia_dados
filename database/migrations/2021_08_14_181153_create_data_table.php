<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data', function (Blueprint $table) {
            $table->id();
            $table->string('cpf');
            $table->boolean('private');
            $table->boolean('incompleto');
            $table->date('data_ultima_compra')->nullable();
            $table->float('ticket_medio')->nullable();
            $table->float('ticket_ultima_compra')->nullable();
            $table->string('loja_mais_frequente')->nullable();
            $table->string('loja_ultima_compra')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dados');
    }
}
