<?php

namespace App\Models\Bndes\NovoSiaf;

use Illuminate\Database\Eloquent\Model;

class SiafContrato extends Model
{
    protected $table = 'TBL_SIAF_CONTRATOS';
    protected $primaryKey = 'contratoCaixa';
    public $incrementing = false;
    public $timestamps = false;
}
