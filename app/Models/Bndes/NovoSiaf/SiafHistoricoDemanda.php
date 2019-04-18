<?php

namespace App\Models\Bndes\NovoSiaf;

use Illuminate\Database\Eloquent\Model;

class SiafHistoricoDemanda extends Model
{
    protected $table = 'tbl_SIAF_HISTORICO_DEMANDAS';
    protected $primaryKey = 'codigoHistorico';

    function SiafDemanda() {
        return $this->belongsTo('App\Models\Bndes\NovoSiaf\SiafDemanda', 'contratoCaixa', 'contratoCaixa');
    }
}
