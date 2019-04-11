<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Bndes\NovoSiaf\Contratos;
use App\Classes\Geral\Ldap;
use App\Empregados;
use App\AcessaEmpregados;
// use App\Models\Bndes\NovoSiaf\TabelaSiafAmortizacoes;
use App\Classes\Bndes\NovoSiaf\SiafPhpMailer;
use App\Classes\Bndes\NovoSiaf\LoteAmortizacaoLiquidacaoSIAF;
use App\Models\Bndes\NovoSiaf\TabelaSiafAmortizacoes;

// Cadastro de nova demanda
$usuario = new Ldap;
$empregado = Empregados::find($usuario->getMatricula());
// echo $empregado;
// echo "<hr>";
// $demanda = Contratos::find($request->input('contratoCaixa'));
// $demanda = Contratos::find('0512.717.0000027-58');
// echo json_encode($demanda);

// Pendencia
// $demanda = TabelaSiafAmortizacoes::find($request->input('contratoCaixa'));
$demanda = TabelaSiafAmortizacoes::find('3688');

$mensageria = new SiafPhpMailer;
$mensageria->enviarMensageria($empregado, $demanda, 'pendenciaSolicitacaoComContaPessoaFisica');