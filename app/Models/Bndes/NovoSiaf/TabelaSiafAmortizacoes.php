<?php

namespace App\Models\Bndes\NovoSiaf;

use Illuminate\Database\Eloquent\Model;

class TabelaSiafAmortizacoes extends Model
{
    protected $table = 'TBL_SIAF_AMORTIZACOES';
    protected $primaryKey = 'CO_PEDIDO';
}
