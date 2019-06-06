<?php

namespace App\Models\Comex;

use Illuminate\Database\Eloquent\Model;

class AcessaEsteiraComex extends Model
{
    protected $table = 'TBL_ACESSA_ESTEIRA_COMEX';
    protected $primaryKey = 'matricula';
    public $incrementing = false;
}
