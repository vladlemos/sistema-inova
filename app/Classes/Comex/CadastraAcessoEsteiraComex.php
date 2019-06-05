<?php

namespace App\Classes\Comex;

use App\Models\Comex\AcessaEsteiraComex;

class CadastraAcessoEsteiraComex
{
    private $matricula;
    private $nivelAcesso;
    private $unidade;
    public $arraySr = [
        '2487', '2489', '2573', '2574', '2575', '2576', '2577', '2578', '2579', '2580', '2581', '2582', '2584', '2585', 
        '2586', '2587', '2588', '2589', '2591', '2592', '2593', '2594', '2595', '2596', '2597', '2598', '2601', '2602', 
        '2603', '2604', '2606', '2607', '2608', '2612', '2613', '2615', '2616', '2617', '2618', '3335', '3410', '3599',
        '3031', '5824', '2506', '2795', '3661', '3675', '3678', '3680', '3683', '3727', '4012', '4169', '4170', '4172', 
        '3332', '2619', '2621', '2622', '2623', '2624', '2625', '2626', '2627', '2628', '2629', '2634', '2635', '2636', 
        '2637', '2639', '2640', '2641', '2642', '2645', '2646', '2647', '2648', '2649', '2650', '2651', '2653', '2654',
        '2655', '2656', '2690', '2691', '2692', '2693', '2694', '3222', '3226', '3227'
    ];
    public $arrayAudir = [
        '7111', '7112', '7849', '7113', '7100', '7114', '7115', '7110', '7116', '7117', '7118', '7119', '7120'
    ];
    public $arrayMatriz = [
        '5624', // GEOPC
        '5199', // GEPOC
        '5637', // GEPOD
        '5174', '5175', '5176', '5177', '5178', '5179', '5181', '5182' // DIRES
    ];
    public $arrayMiddle = [
        'C091639', // Bruno
        'C117210', // Carolina
        'C116287', // Celia
        'C086812', // Daniela
        'C106407', // Nantes
        'C063490', // Erica
        'C111697', // Guilherme
        'C114783', // Juliane
        'C077793', // Leticia
        'C095053', // Marina
        'C121708', // Thais
        'C113591'  // Thiago
    ];
    public $arrayGestor = [
        /* GESTORES */
        'C121472', // Claudia
        'C113608', // Daniele
        'C084683', // Eidi
        'C061940', // Eliana
        'C052617', // Lucyenne
        'C086282', // Ricardo
        'C058725', // Thais Jomah
        /* DESENVOLVIMENTO */
        'C142765', // Carlos
        'C111710', // Chuman
        'C095060', // Denise
        'C079436'  // Vladimir
    ];

    /**
     * Get the value of matricula
     */ 
    public function getMatricula()
    {
        return $this->matricula;
    }

    /**
     * Set the value of matricula
     *
     * @return  self
     */ 
    public function setMatricula($matricula)
    {
        $this->matricula = $matricula;

        return $this;
    }

    /**
     * Get the value of nivelAcesso
     */ 
    public function getNivelAcesso()
    {
        return $this->nivelAcesso;
    }

    /**
     * Set the value of nivelAcesso
     *
     * @return  self
     */ 
    public function setNivelAcesso($objEmpregado)
    {
        if ($objEmpregado->codigoLotacaoFisica === null) {
            $this->setUnidade($objEmpregado->codigoLotacaoAdministrativa);
        } else {
            $this->setUnidade($objEmpregado->codigoLotacaoFisica);
        }
        if(in_array($this->getUnidade(), $this->arraySr)) {
            $this->nivelAcesso = 'SR';
        } elseif (in_array($this->getUnidade(), $this->arrayAudir)) {
            $this->nivelAcesso = 'AUDITOR';
        } elseif (in_array($this->getUnidade(), $this->arrayMatriz)) {
            $this->nivelAcesso = 'MATRIZ';
        } elseif ($this->getUnidade() == '5459') {
            $this->nivelAcesso = 'CEOPC';
        } elseif (in_array($this->getUnidade(), $this->arrayMiddle)) {
            $this->nivelAcesso = 'MIDDLE';
        } elseif (in_array($this->getUnidade(), $this->arrayGestor)) {
            $this->nivelAcesso = 'GESTOR';
        } elseif ($this->getUnidade() == '5424') {
            $this->nivelAcesso = 'GECAM';
        } elseif ($this->getUnidade() == '5510') {
            $this->nivelAcesso = 'GELIT';
        } elseif ($this->getUnidade() == '7854') {
            $this->nivelAcesso = 'CELIT';
        } else {
            $this->nivelAcesso = 'AGÊNCIA';
        }
        return $this;
    }

    /**
     * Get the value of unidade
     */ 
    public function getUnidade()
    {
        return $this->unidade;
    }

    /**
     * Set the value of unidade
     *
     * @return  self
     */ 
    public function setUnidade($unidade)
    {
        $this->unidade = $unidade;

        return $this;
    }

    public function __construct($objEmpregado)
    {
        $this->setMatricula($objEmpregado->getMatricula());
        $this->setNivelAcesso($objEmpregado);
        $this->atualizarPerfilAcessoEsteira();
    }

    public function atualizaPerfilAcessoEsteira()
    {
        $cadastroAcesso = AcessaEsteiraComex::firstOrNew(array('matricula' => $this->getMatricula()));
        $cadastroAcesso->matricula = $this->getMatricula();
        $cadastroAcesso->nivelAcesso = $this->getNivelAcesso();
        $cadastroAcesso->unidade = $this->getUnidade();
        $cadastroAcesso->save();
    }
}