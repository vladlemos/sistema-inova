<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Demandas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('TBL_EST_CONTRATACAO_DEMANDAS', function (Blueprint $table) 
        {
            
            $table->increments('idDemanda');
            $table->string('tipoPessoa',2);
            $table->string('cpf',11)->nullable($value = true);
            $table->string('cnpj',14)->nullable($value = true);
            $table->string('nomeCliente',60);
            $table->string('tipoOperacao',60);
            $table->string('tipoMoeda',3);
            $table->decimal('valorOperacao',17,2);
            $table->date('dataPrevistaEmbarque');
            $table->date('dataLiquidacao')->nullable($value = true);
            $table->string('statusAtual', 100);
            $table->string('responsavelAtual',7);
            $table->string('agResponsavel',4)->nullable($value = true);
            $table->string('srResponsavel',4)->nullable($value = true);
            $table->text('analiseCeopc',4)->nullable($value = true);
            $table->text('analiseAg',4)->nullable($value = true);
            $table->string('numeroBoleto',4)->nullable($value = true);
        });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('TBL_EST_CONTRATACAO_DEMANDAS');
    }
}
