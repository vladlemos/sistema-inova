<?php

namespace App\Http\Controllers\Sistemas;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Classes\Geral\Ldap;
use App\Empregados;
use App\AcessaEmpregados;


class EmpregadosController extends Controller
{
    public function dadosEmpregado()
    {
        $usuario = new Ldap;
        $empregado = Empregados::find($usuario->getMatricula());
        $empregadoAcesso = DB::table('tbl_empregados')
                            ->join('tbl_acessa_empregado', 'tbl_empregados.matricula', '=', 'tbl_acessa_empregado.matricula')
                            ->select('tbl_empregados.matricula','tbl_empregados.nome_completo', 'tbl_empregados.nome_funcao', 'tbl_empregados.codigo_lotacao_administrativa', 'tbl_empregados.nome_lotacao_administrativa', 'tbl_empregados.codigo_lotacao_fisica', 'tbl_empregados.nome_lotacao_fisica',  'tbl_acessa_empregado.nivel_acesso')
                            // ->select('tbl_empregados.matricula', 'tbl_empregados.nome_completo', 'tbl_empregados.nome_funcao', 'tbl_empregados.codigo_lotacao_administrativa',  'tbl_acessa_empregado.nivel_acesso')
                            ->where('tbl_acessa_empregado.matricula', '=', $usuario->getMatricula())
                            ->get();
            // $empregado->acessoEmpregado()
            // ->with('empregado')
            // ->join('empregado', 'empregado.matricula', '=', 'acessaEmpregado.matricula')
            // ->get(['empregado.*', 'acessaEmpregado.nivel_acesso']);
        return json_encode($empregadoAcesso, JSON_UNESCAPED_SLASHES);
    }
}