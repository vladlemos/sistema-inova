<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AcessaEmpregado extends Model
{
    protected $table = 'tbl_acessa_empregado';
    protected $primaryKey = 'matricula';
    public $incrementing = false;

    public function empregados()
    {
        return $this->belongsTo('Empregados');
    }
}
