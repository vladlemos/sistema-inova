<?php

namespace App\Models\Bndes\NovoSiaf;

use Illuminate\Database\Eloquent\Model;

class SiafHistoricoSaldoContaAmortizacao extends Model
{
    protected $table = 'tbl_SIAF_HISTORICO_SALDO_CONTA_AMORTIZACOES';
    protected $primaryKey = 'codigoHistorico';
}
