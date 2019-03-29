<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empregados extends Model
{
    protected $table = 'tbl_empregados';
    protected $primaryKey = 'matricula';
    public $incrementing = false;
    protected $fillable = 
        [
            'nome_completo',
            'primeiro_nome',
            'data_de_nascimento',
            'codigo_funcao',
            'nome_funcao',
            'codigo_lotacao_administrativa',
            'nome_lotacao_administrativa',
            'codigo_lotacao_fisica',
            'nome_lotacao_fisica',
            'foto_empregado',
        ];
    public function acessoEmpregado()
    {
        return $this->hasMany('AcessaEmpregados');
    }
}
