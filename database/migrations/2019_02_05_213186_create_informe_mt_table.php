<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInformeMTTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('informe_mt', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ref');
            $table->string('nombre_producto');
            $table->integer('saldo_geminus');
            $table->integer('cantidad');
            $table->integer('conteo');
            $table->string('diferencia');
            $table->string('mv_mensual');
            $table->string('porcentaje_mv_diferencia'); 
            $table->string('mes');
            $table->string('year');
            $table->date('fecha');
            $table->integer('costo_unitario');
            $table->integer('costo_total');
            $table->integer('costo_diferencia');
            $table->integer('id_calendario')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('informe_mt');
    }
}
