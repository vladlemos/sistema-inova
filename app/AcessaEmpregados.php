<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AcessaEmpregados extends Model
{
    protected $table = 'tbl_acessa_empregado';
    protected $primaryKey = 'matricula';

    public function empregados()
    {
        return $this->belongsTo('Empregados');
    }
}
