<?php

namespace App\Models\Bndes\NovoSiaf;

use Illuminate\Database\Eloquent\Model;

class SiafDemanda extends Model
{
    protected $table = 'TBL_SIAF_DEMANDAS';
    protected $primaryKey = 'codigoDemanda';

    function SiafHistoricoDemanda() {
        return $this->hasMany('App\Models\Bndes\NovoSiaf\SiafHistoricoDemanda', 'contratoCaixa', 'contratoCaixa');
    }

    function SiafHistoricoSaldoContaAmortizacao() {
        return $this->hasMany('App\Models\Bndes\NovoSiaf\SiafHistoricoSaldoContaAmortizacao', 'contratoCaixa', 'contratoCaixa');
    }
}
