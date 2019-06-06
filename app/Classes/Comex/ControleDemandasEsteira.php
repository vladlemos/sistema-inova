<?php

namespace App\Classes\Comex;

use Illuminate\Support\Facades\DB;

class ControleDemandasEsteira
{
    private $dataAtualizacaoBaseSuint = '30/08/2018'; //$datadeatualizacao
    private $contagemDemandasCadastradasLiquidacao; //$badget_cadastrada
    private $contagemDemandasCadastradasAntecipadosCambioPronto; //$badget_cadastrada_antecipados
    private $contagemDemandasDistribuidasLiquidacao; //$badget_usuario
    private $contagemDemandasEmAnaliseLiquidacao; //$badget_usuario_em
    private $contademDemandasDistribuidasAntecipadoCambioPronto; //$badget_cadastrada_antecipados_usuario

    //$dataAtualizacaoBaseSuint
    public function getDataAtualizacaoBaseSuint()
    {
        return $this->dataAtualizacaoBaseSuint;
    }

    public function __construct($objEmpregado)
    {
        $this->setContagemDemandasCadastradasLiquidacao();
        $this->setContagemDemandasCadastradasAntecipadosCambioPronto();
        $this->setContagemDemandasDistribuidasLiquidacao($objEmpregado);
        $this->setContagemDemandasEmAnaliseLiquidacao($objEmpregado);
        $this->setContademDemandasDistribuidasAntecipadoCambioPronto($objEmpregado);       
    }

    public function __toString()
    {
        return json_encode(array(
            "DATA_ATUALIZACAO_BASE_SUINT"=>$this->getDataAtualizacaoBaseSuint(),
            "CONTAR_DEMANDAS_CADASTRADAS_LIQUIDACAO_COMEX"=>$this->getContagemDemandasCadastradasLiquidacao(),
            "CONTAR_DEMANDAS_CADASTRADAS_ANTECIPADOS_CAMBIO_PRONTO"=>$this->getContagemDemandasCadastradasAntecipadosCambioPronto(),
            "CONTAR_DEMANDAS_DISTRIBUIDAS_LIQUIDACAO_COMEX"=>$this->getContagemDemandasDistribuidasLiquidacao(),
            "CONTAR_DEMANDAS_EM_ANALISE_LIQUIDACAO_COMEX"=>$this->getContagemDemandasEmAnaliseLiquidacao(),
            "CONTAR_DEMANDAS_DISTRIBUIDAS_ANTECIPADOS_CAMBIO_PRONTO"=>$this->getContademDemandasDistribuidasAntecipadoCambioPronto()          
        ), JSON_UNESCAPED_SLASHES);
    }

    //$contagemDemandasCadastradasLiquidacao;
    public function getContagemDemandasCadastradasLiquidacao()
    {
        return $this->contagemDemandasCadastradasLiquidacao;
    }
    public function setContagemDemandasCadastradasLiquidacao()
    {
        $contador = DB::select("
            SELECT 
                COUNT([CO_LIQ]) AS QUANTIDADE_CAD_LIQ 
            FROM 
                [dbo].[tbl_LIQUIDACAO] 
            WHERE 
                [CO_STATUS] = 'CADASTRADA'
            ");
        
        $this->contagemDemandasCadastradasLiquidacao = $contador[0]['QUANTIDADE_CAD_LIQ'];
    }
}