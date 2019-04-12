<?php

namespace App\Http\Controllers\Bndes\NovoSiaf;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Bndes\NovoSiaf\TabelaSiafAmortizacoes;
use App\Classes\Bndes\NovoSiaf\LoteAmortizacaoLiquidacaoSIAF;
use App\Models\Bndes\NovoSiaf\Contratos;
use App\Classes\Geral\Ldap;
use App\Empregados;
use App\AcessaEmpregados;
use App\Http\Controllers\Sistemas\EmpregadosController;

class TabelaSiafAmortizacoesController extends Controller
{
    public $arrayGigad = [
        '7641', '7639', '7640', '7606', '7648', '7647', '7649', '7652', '7655', '7658', '7657', '7659', '7660', '7661'
    ];
    public $arraySR = [
        '2487', '2489', '2573', '2574', '2575', '2576', '2577', '2578', '2579', '2580', '2581', '2582', '2584', '2585', 
        '2586', '2587', '2588', '2589', '2591', '2592', '2593', '2594', '2595', '2596', '2597', '2598', '2601', '2602', 
        '2603', '2604', '2606', '2607', '2608', '2612', '2613', '2615', '2616', '2617', '2618', '3335', '3410', '3599',
        '3031', '5824', '2506', '2795', '3661', '3675', '3678', '3680', '3683', '3727', '4012', '4169', '4170', '4172', 
        '3332', '2619', '2621', '2622', '2623', '2624', '2625', '2626', '2627', '2628', '2629', '2634', '2635', '2636', 
        '2637', '2639', '2640', '2641', '2642', '2645', '2646', '2647', '2648', '2649', '2650', '2651', '2653', '2654',
        '2655', '2656', '2690', '2691', '2692', '2693', '2694', '3222', '3226', '3227'
    ];
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    public function loteAnterior()
    {
        $usuario = new Ldap;
        $empregado = Empregados::find($usuario->getMatricula());
        $empregadoAcesso = DB::table('tbl_empregados')
                            ->join('tbl_acessa_empregado', 'tbl_empregados.matricula', '=', 'tbl_acessa_empregado.matricula')
                            ->select('tbl_empregados.*', 'tbl_acessa_empregado.nivel_acesso')
                            ->where('tbl_acessa_empregado.matricula', '=', $usuario->getMatricula())
                            ->get();
        switch ($empregadoAcesso[0]->nivel_acesso) {
            case 'EMPREGADO_AG':
                if ($empregadoAcesso[0]->codigo_lotacao_fisica === null) {
                    $lote = new LoteAmortizacaoLiquidacaoSIAF;       
                    $loteAnterior = DB::table('TBL_SIAF_AMORTIZACOES')
                                        ->select('CO_PEDIDO', 'NO_CLIENTE', 'CO_CNPJ', 'CONTRATO_CAIXA', 'CONTRATO_BNDES', 'VL_AMORTIZADO', 'CONTA_CORRENTE', 'STATUS',
                                            DB::raw("(CASE WHEN TP_AMORTIZACAO = 'L' THEN 'LIQUIDACAO' WHEN TP_AMORTIZACAO = 'A' THEN 'AMORTIZACAO' END) AS TP_AMORTIZACAO"))
                                        ->where('CO_PA', '=', $empregadoAcesso[0]->codigo_lotacao_administrativa)
                                        ->where('DT_LT_AMORTIZADOR', '=', $lote->getDataLoteAnterior())             
                                        ->get(); 
                    return json_encode($loteAnterior, JSON_UNESCAPED_SLASHES);
                } elseif (in_array($empregadoAcesso[0]->codigo_lotacao_fisica, $this->arrayGigad)) {
                    $lote = new LoteAmortizacaoLiquidacaoSIAF;
                    $loteAnterior = DB::table('TBL_SIAF_AMORTIZACOES')
                                    ->select('CO_PEDIDO', 'NO_CLIENTE', 'CO_CNPJ', 'CONTRATO_CAIXA', 'CONTRATO_BNDES', 'VL_AMORTIZADO', 'CONTA_CORRENTE', 'STATUS',
                                        DB::raw("(CASE WHEN TP_AMORTIZACAO = 'L' THEN 'LIQUIDACAO' WHEN TP_AMORTIZACAO = 'A' THEN 'AMORTIZACAO' END) AS TP_AMORTIZACAO"))
                                    ->where('CO_GIGAD', '=', $empregadoAcesso[0]->codigo_lotacao_fisica)
                                    ->where('DT_LT_AMORTIZADOR', '=', $lote->getDataLoteAnterior())
                                    ->get();    
                    return json_encode($loteAnterior, JSON_UNESCAPED_SLASHES);
                } elseif (in_array($empregadoAcesso[0]->codigo_lotacao_fisica, $this->arraySR)) {
                    $lote = new LoteAmortizacaoLiquidacaoSIAF;       
                    $loteAnterior = DB::table('TBL_SIAF_AMORTIZACOES')
                                    ->select('CO_PEDIDO', 'NO_CLIENTE', 'CO_CNPJ', 'CONTRATO_CAIXA', 'CONTRATO_BNDES', 'VL_AMORTIZADO', 'CONTA_CORRENTE', 'STATUS',
                                        DB::raw("(CASE WHEN TP_AMORTIZACAO = 'L' THEN 'LIQUIDACAO' WHEN TP_AMORTIZACAO = 'A' THEN 'AMORTIZACAO' END) AS TP_AMORTIZACAO"))
                                    ->where('CO_SR', '=', $empregadoAcesso[0]->codigo_lotacao_fisica)
                                    ->where('DT_LT_AMORTIZADOR', '=', $lote->getDataLoteAnterior())
                                    ->get();      
                    return json_encode($loteAnterior, JSON_UNESCAPED_SLASHES);
                } else {
                    $lote = new LoteAmortizacaoLiquidacaoSIAF;       
                    $loteAnterior = DB::table('TBL_SIAF_AMORTIZACOES')
                                    ->select('CO_PEDIDO', 'NO_CLIENTE', 'CO_CNPJ', 'CONTRATO_CAIXA', 'CONTRATO_BNDES', 'VL_AMORTIZADO', 'CONTA_CORRENTE', 'STATUS',
                                        DB::raw("(CASE WHEN TP_AMORTIZACAO = 'L' THEN 'LIQUIDACAO' WHEN TP_AMORTIZACAO = 'A' THEN 'AMORTIZACAO' END) AS TP_AMORTIZACAO"))
                                    ->where('CO_PA', '=', $empregadoAcesso[0]->codigo_lotacao_fisica)
                                    ->where('DT_LT_AMORTIZADOR', '=', $lote->getDataLoteAnterior())
                                    ->get();       
                    return json_encode($loteAnterior, JSON_UNESCAPED_SLASHES);
                }                   
                break;
            case 'EMPREGADO_SR':
                if ($empregadoAcesso[0]->codigo_lotacao_fisica === null) {
                    $lote = new LoteAmortizacaoLiquidacaoSIAF;       
                    $loteAnterior = DB::table('TBL_SIAF_AMORTIZACOES')
                                    ->select('CO_PEDIDO', 'NO_CLIENTE', 'CO_CNPJ', 'CONTRATO_CAIXA', 'CONTRATO_BNDES', 'VL_AMORTIZADO', 'CONTA_CORRENTE', 'STATUS',
                                        DB::raw("(CASE WHEN TP_AMORTIZACAO = 'L' THEN 'LIQUIDACAO' WHEN TP_AMORTIZACAO = 'A' THEN 'AMORTIZACAO' END) AS TP_AMORTIZACAO"))
                                    ->where('CO_SR', '=', $empregadoAcesso[0]->codigo_lotacao_administrativa)
                                    ->where('DT_LT_AMORTIZADOR', '=', $lote->getDataLoteAnterior())
                                    ->get();       
                    return json_encode($loteAnterior, JSON_UNESCAPED_SLASHES);
                } elseif (in_array($empregadoAcesso[0]->codigo_lotacao_fisica, $this->arrayGigad)) {
                    $lote = new LoteAmortizacaoLiquidacaoSIAF;
                    $loteAnterior = DB::table('TBL_SIAF_AMORTIZACOES')
                                    ->select('CO_PEDIDO', 'NO_CLIENTE', 'CO_CNPJ', 'CONTRATO_CAIXA', 'CONTRATO_BNDES', 'VL_AMORTIZADO', 'CONTA_CORRENTE', 'STATUS',
                                        DB::raw("(CASE WHEN TP_AMORTIZACAO = 'L' THEN 'LIQUIDACAO' WHEN TP_AMORTIZACAO = 'A' THEN 'AMORTIZACAO' END) AS TP_AMORTIZACAO"))
                                    ->where('CO_GIGAD', '=', $empregadoAcesso[0]->codigo_lotacao_fisica)
                                    ->where('DT_LT_AMORTIZADOR', '=', $lote->getDataLoteAnterior())
                                    ->get();      
                    return json_encode($loteAnterior, JSON_UNESCAPED_SLASHES);
                } elseif (in_array($empregadoAcesso[0]->codigo_lotacao_fisica, $this->arraySR)) {
                    $lote = new LoteAmortizacaoLiquidacaoSIAF;       
                    $loteAnterior = DB::table('TBL_SIAF_AMORTIZACOES')
                                    ->select('CO_PEDIDO', 'NO_CLIENTE', 'CO_CNPJ', 'CONTRATO_CAIXA', 'CONTRATO_BNDES', 'VL_AMORTIZADO', 'CONTA_CORRENTE', 'STATUS',
                                        DB::raw("(CASE WHEN TP_AMORTIZACAO = 'L' THEN 'LIQUIDACAO' WHEN TP_AMORTIZACAO = 'A' THEN 'AMORTIZACAO' END) AS TP_AMORTIZACAO"))
                                    ->where('CO_SR', '=', $empregadoAcesso[0]->codigo_lotacao_fisica)
                                    ->where('DT_LT_AMORTIZADOR', '=', $lote->getDataLoteAnterior())
                                    ->get();     
                    return json_encode($loteAnterior, JSON_UNESCAPED_SLASHES);
                } else {
                    $lote = new LoteAmortizacaoLiquidacaoSIAF;       
                    $loteAnterior = DB::table('TBL_SIAF_AMORTIZACOES')
                                    ->select('CO_PEDIDO', 'NO_CLIENTE', 'CO_CNPJ', 'CONTRATO_CAIXA', 'CONTRATO_BNDES', 'VL_AMORTIZADO', 'CONTA_CORRENTE', 'STATUS',
                                        DB::raw("(CASE WHEN TP_AMORTIZACAO = 'L' THEN 'LIQUIDACAO' WHEN TP_AMORTIZACAO = 'A' THEN 'AMORTIZACAO' END) AS TP_AMORTIZACAO"))
                                    ->where('CO_PA', '=', $empregadoAcesso[0]->codigo_lotacao_fisica)
                                    ->where('DT_LT_AMORTIZADOR', '=', $lote->getDataLoteAnterior())
                                    ->get();      
                    return json_encode($loteAnterior, JSON_UNESCAPED_SLASHES);
                }                   
                break;
            case 'GIGAD':
                if ($empregadoAcesso[0]->codigo_lotacao_fisica === null) {
                    $lote = new LoteAmortizacaoLiquidacaoSIAF;       
                    $loteAnterior = DB::table('TBL_SIAF_AMORTIZACOES')
                                    ->select('CO_PEDIDO', 'NO_CLIENTE', 'CO_CNPJ', 'CONTRATO_CAIXA', 'CONTRATO_BNDES', 'VL_AMORTIZADO', 'CONTA_CORRENTE', 'STATUS',
                                        DB::raw("(CASE WHEN TP_AMORTIZACAO = 'L' THEN 'LIQUIDACAO' WHEN TP_AMORTIZACAO = 'A' THEN 'AMORTIZACAO' END) AS TP_AMORTIZACAO"))
                                    ->where('CO_GIGAD', '=', $empregadoAcesso[0]->codigo_lotacao_administrativa)
                                    ->where('DT_LT_AMORTIZADOR', '=', $lote->getDataLoteAnterior())
                                    ->get();    
                    return json_encode($loteAnterior, JSON_UNESCAPED_SLASHES);
                } elseif (in_array($empregadoAcesso[0]->codigo_lotacao_fisica, $this->arrayGigad)) {
                    $lote = new LoteAmortizacaoLiquidacaoSIAF;
                    $loteAnterior = DB::table('TBL_SIAF_AMORTIZACOES')
                                    ->select('CO_PEDIDO', 'NO_CLIENTE', 'CO_CNPJ', 'CONTRATO_CAIXA', 'CONTRATO_BNDES', 'VL_AMORTIZADO', 'CONTA_CORRENTE', 'STATUS',
                                        DB::raw("(CASE WHEN TP_AMORTIZACAO = 'L' THEN 'LIQUIDACAO' WHEN TP_AMORTIZACAO = 'A' THEN 'AMORTIZACAO' END) AS TP_AMORTIZACAO"))
                                    ->where('CO_GIGAD', '=', $empregadoAcesso[0]->codigo_lotacao_fisica)
                                    ->where('DT_LT_AMORTIZADOR', '=', $lote->getDataLoteAnterior())
                                    ->get();        
                    return json_encode($loteAnterior, JSON_UNESCAPED_SLASHES);
                } elseif (in_array($empregadoAcesso[0]->codigo_lotacao_fisica, $this->arraySR)) {
                    $lote = new LoteAmortizacaoLiquidacaoSIAF;       
                    $loteAnterior = DB::table('TBL_SIAF_AMORTIZACOES')
                                    ->select('CO_PEDIDO', 'NO_CLIENTE', 'CO_CNPJ', 'CONTRATO_CAIXA', 'CONTRATO_BNDES', 'VL_AMORTIZADO', 'CONTA_CORRENTE', 'STATUS',
                                        DB::raw("(CASE WHEN TP_AMORTIZACAO = 'L' THEN 'LIQUIDACAO' WHEN TP_AMORTIZACAO = 'A' THEN 'AMORTIZACAO' END) AS TP_AMORTIZACAO"))
                                    ->where('CO_SR', '=', $empregadoAcesso[0]->codigo_lotacao_fisica)
                                    ->where('DT_LT_AMORTIZADOR', '=', $lote->getDataLoteAnterior())
                                    ->get();      
                    return json_encode($loteAnterior, JSON_UNESCAPED_SLASHES);
                } else {
                    $lote = new LoteAmortizacaoLiquidacaoSIAF;       
                    $loteAnterior = DB::table('TBL_SIAF_AMORTIZACOES')
                                    ->select('CO_PEDIDO', 'NO_CLIENTE', 'CO_CNPJ', 'CONTRATO_CAIXA', 'CONTRATO_BNDES', 'VL_AMORTIZADO', 'CONTA_CORRENTE', 'STATUS',
                                        DB::raw("(CASE WHEN TP_AMORTIZACAO = 'L' THEN 'LIQUIDACAO' WHEN TP_AMORTIZACAO = 'A' THEN 'AMORTIZACAO' END) AS TP_AMORTIZACAO"))
                                    ->where('CO_PA', '=', $empregadoAcesso[0]->codigo_lotacao_fisica)
                                    ->where('DT_LT_AMORTIZADOR', '=', $lote->getDataLoteAnterior())
                                    ->get();       
                    return json_encode($loteAnterior, JSON_UNESCAPED_SLASHES);
                }
                break;
            default:
            $lote = new LoteAmortizacaoLiquidacaoSIAF;       
            $loteAnterior = DB::table('TBL_SIAF_AMORTIZACOES')
                                ->select('CO_PEDIDO', 'NO_CLIENTE', 'CO_CNPJ', 'CONTRATO_CAIXA', 'CONTRATO_BNDES', 'VL_AMORTIZADO', 'CONTA_CORRENTE', 'STATUS',
                                    DB::raw("(CASE WHEN TP_AMORTIZACAO = 'L' THEN 'LIQUIDACAO' WHEN TP_AMORTIZACAO = 'A' THEN 'AMORTIZACAO' END) AS TP_AMORTIZACAO"))
                                ->where('DT_LT_AMORTIZADOR', '=', $lote->getDataLoteAnterior())
                                ->get();
            return json_encode($loteAnterior, JSON_UNESCAPED_SLASHES);
                break;
        }
    }

    public function loteAtual()
    {
        $usuario = new Ldap;
        $empregado = Empregados::find($usuario->getMatricula());
        $empregadoAcesso = DB::table('tbl_empregados')
                            ->join('tbl_acessa_empregado', 'tbl_empregados.matricula', '=', 'tbl_acessa_empregado.matricula')
                            ->select('tbl_empregados.*', 'tbl_acessa_empregado.nivel_acesso')
                            ->where('tbl_acessa_empregado.matricula', '=', $usuario->getMatricula())
                            ->get();
        
        switch ($empregadoAcesso[0]->nivel_acesso) {
            case 'EMPREGADO_AG':
                if ($empregadoAcesso[0]->codigo_lotacao_fisica === null) {
                    $lote = new LoteAmortizacaoLiquidacaoSIAF;
                    $loteAnterior = DB::table('TBL_SIAF_AMORTIZACOES')
                                        ->select('CO_PEDIDO', 'NO_CLIENTE', 'CO_CNPJ', 'CONTRATO_CAIXA', 'CONTRATO_BNDES', 'VL_AMORTIZADO', 'CONTA_CORRENTE', 'STATUS',
                                            DB::raw("(CASE WHEN TP_AMORTIZACAO = 'L' THEN 'LIQUIDACAO' WHEN TP_AMORTIZACAO = 'A' THEN 'AMORTIZACAO' END) AS TP_AMORTIZACAO"))
                                        ->where('DT_LT_AMORTIZADOR', '=', $lote->getDataLoteAtual())
                                        ->where('CO_PA', '=', $empregadoAcesso[0]->codigo_lotacao_administrativa)
                                        ->get();       
                    return json_encode($loteAnterior, JSON_UNESCAPED_SLASHES);
                } elseif (in_array($empregadoAcesso[0]->codigo_lotacao_fisica, $this->arrayGigad)) {
                    $lote = new LoteAmortizacaoLiquidacaoSIAF;
                    $loteAnterior = DB::table('TBL_SIAF_AMORTIZACOES')
                                    ->select('CO_PEDIDO', 'NO_CLIENTE', 'CO_CNPJ', 'CONTRATO_CAIXA', 'CONTRATO_BNDES', 'VL_AMORTIZADO', 'CONTA_CORRENTE', 'STATUS',
                                        DB::raw("(CASE WHEN TP_AMORTIZACAO = 'L' THEN 'LIQUIDACAO' WHEN TP_AMORTIZACAO = 'A' THEN 'AMORTIZACAO' END) AS TP_AMORTIZACAO"))
                                    ->where('DT_LT_AMORTIZADOR', '=', $lote->getDataLoteAtual())
                                    ->where('CO_GIGAD', '=', $empregadoAcesso[0]->codigo_lotacao_fisica)
                                    ->get();        
                    return json_encode($loteAnterior, JSON_UNESCAPED_SLASHES);
                } elseif (in_array($empregadoAcesso[0]->codigo_lotacao_fisica, $this->arraySR)) {
                    $lote = new LoteAmortizacaoLiquidacaoSIAF;
                    $loteAnterior = DB::table('TBL_SIAF_AMORTIZACOES')
                                    ->select('CO_PEDIDO', 'NO_CLIENTE', 'CO_CNPJ', 'CONTRATO_CAIXA', 'CONTRATO_BNDES', 'VL_AMORTIZADO', 'CONTA_CORRENTE', 'STATUS',
                                        DB::raw("(CASE WHEN TP_AMORTIZACAO = 'L' THEN 'LIQUIDACAO' WHEN TP_AMORTIZACAO = 'A' THEN 'AMORTIZACAO' END) AS TP_AMORTIZACAO"))
                                    ->where('DT_LT_AMORTIZADOR', '=', $lote->getDataLoteAtual())
                                    ->where('CO_SR', '=', $empregadoAcesso[0]->codigo_lotacao_fisica)
                                    ->get();         
                    return json_encode($loteAnterior, JSON_UNESCAPED_SLASHES);
                } else {
                    $lote = new LoteAmortizacaoLiquidacaoSIAF;
                    $loteAnterior = DB::table('TBL_SIAF_AMORTIZACOES')
                                    ->select('CO_PEDIDO', 'NO_CLIENTE', 'CO_CNPJ', 'CONTRATO_CAIXA', 'CONTRATO_BNDES', 'VL_AMORTIZADO', 'CONTA_CORRENTE', 'STATUS',
                                        DB::raw("(CASE WHEN TP_AMORTIZACAO = 'L' THEN 'LIQUIDACAO' WHEN TP_AMORTIZACAO = 'A' THEN 'AMORTIZACAO' END) AS TP_AMORTIZACAO"))
                                    ->where('DT_LT_AMORTIZADOR', '=', $lote->getDataLoteAtual())
                                    ->where('CO_PA', '=', $empregadoAcesso[0]->codigo_lotacao_fisica)
                                    ->get();        
                    return json_encode($loteAnterior, JSON_UNESCAPED_SLASHES);
                }
                break;
            case 'EMPREGADO_SR':
                if ($empregadoAcesso[0]->codigo_lotacao_fisica === null) {
                    $lote = new LoteAmortizacaoLiquidacaoSIAF;       
                    $loteAnterior = DB::table('TBL_SIAF_AMORTIZACOES')
                                        ->select('CO_PEDIDO', 'NO_CLIENTE', 'CO_CNPJ', 'CONTRATO_CAIXA', 'CONTRATO_BNDES', 'VL_AMORTIZADO', 'CONTA_CORRENTE', 'STATUS',
                                            DB::raw("(CASE WHEN TP_AMORTIZACAO = 'L' THEN 'LIQUIDACAO' WHEN TP_AMORTIZACAO = 'A' THEN 'AMORTIZACAO' END) AS TP_AMORTIZACAO"))
                                        ->where('DT_LT_AMORTIZADOR', '=', $lote->getDataLoteAtual())
                                        ->where('CO_SR', '=', $empregadoAcesso[0]->codigo_lotacao_administrativa)
                                        ->get();       
                    return json_encode($loteAnterior, JSON_UNESCAPED_SLASHES);
                } else {
                    if (in_array($empregadoAcesso[0]->codigo_lotacao_fisica, $this->arrayGigad)) {
                        $lote = new LoteAmortizacaoLiquidacaoSIAF;
                        $loteAnterior = DB::table('TBL_SIAF_AMORTIZACOES')
                                        ->select('CO_PEDIDO', 'NO_CLIENTE', 'CO_CNPJ', 'CONTRATO_CAIXA', 'CONTRATO_BNDES', 'VL_AMORTIZADO', 'CONTA_CORRENTE', 'STATUS',
                                            DB::raw("(CASE WHEN TP_AMORTIZACAO = 'L' THEN 'LIQUIDACAO' WHEN TP_AMORTIZACAO = 'A' THEN 'AMORTIZACAO' END) AS TP_AMORTIZACAO"))
                                        ->where('DT_LT_AMORTIZADOR', '=', $lote->getDataLoteAtual())
                                        ->where('CO_GIGAD', '=', $empregadoAcesso[0]->codigo_lotacao_fisica)
                                        ->get();        
                        return json_encode($loteAnterior, JSON_UNESCAPED_SLASHES);
                    } elseif (in_array($empregadoAcesso[0]->codigo_lotacao_fisica, $this->arraySR)) {
                        $lote = new LoteAmortizacaoLiquidacaoSIAF;       
                        $loteAnterior = DB::table('TBL_SIAF_AMORTIZACOES')
                                        ->select('CO_PEDIDO', 'NO_CLIENTE', 'CO_CNPJ', 'CONTRATO_CAIXA', 'CONTRATO_BNDES', 'VL_AMORTIZADO', 'CONTA_CORRENTE', 'STATUS',
                                            DB::raw("(CASE WHEN TP_AMORTIZACAO = 'L' THEN 'LIQUIDACAO' WHEN TP_AMORTIZACAO = 'A' THEN 'AMORTIZACAO' END) AS TP_AMORTIZACAO"))
                                        ->where('DT_LT_AMORTIZADOR', '=', $lote->getDataLoteAtual())
                                        ->where('CO_SR', '=', $empregadoAcesso[0]->codigo_lotacao_fisica)
                                        ->get();      
                        return json_encode($loteAnterior, JSON_UNESCAPED_SLASHES);
                    } else {
                        $lote = new LoteAmortizacaoLiquidacaoSIAF;       
                        $loteAnterior = DB::table('TBL_SIAF_AMORTIZACOES')
                                        ->select('CO_PEDIDO', 'NO_CLIENTE', 'CO_CNPJ', 'CONTRATO_CAIXA', 'CONTRATO_BNDES', 'VL_AMORTIZADO', 'CONTA_CORRENTE', 'STATUS',
                                            DB::raw("(CASE WHEN TP_AMORTIZACAO = 'L' THEN 'LIQUIDACAO' WHEN TP_AMORTIZACAO = 'A' THEN 'AMORTIZACAO' END) AS TP_AMORTIZACAO"))
                                        ->where('DT_LT_AMORTIZADOR', '=', $lote->getDataLoteAtual())
                                        ->where('CO_PA', '=', $empregadoAcesso[0]->codigo_lotacao_fisica)
                                        ->get();       
                        return json_encode($loteAnterior, JSON_UNESCAPED_SLASHES);
                    }                   
                }
                break;
            case 'GIGAD':
                if ($empregadoAcesso[0]->codigo_lotacao_fisica === null) {
                    $lote = new LoteAmortizacaoLiquidacaoSIAF;       
                    $loteAnterior = DB::table('TBL_SIAF_AMORTIZACOES')
                                        ->select('CO_PEDIDO', 'NO_CLIENTE', 'CO_CNPJ', 'CONTRATO_CAIXA', 'CONTRATO_BNDES', 'VL_AMORTIZADO', 'CONTA_CORRENTE', 'STATUS',
                                            DB::raw("(CASE WHEN TP_AMORTIZACAO = 'L' THEN 'LIQUIDACAO' WHEN TP_AMORTIZACAO = 'A' THEN 'AMORTIZACAO' END) AS TP_AMORTIZACAO"))
                                        ->where('DT_LT_AMORTIZADOR', '=', $lote->getDataLoteAtual())
                                        ->where('CO_GIGAD', '=', $empregadoAcesso[0]->codigo_lotacao_administrativa)
                                        ->get();   
                    return json_encode($loteAnterior, JSON_UNESCAPED_SLASHES);
                } elseif (in_array($empregadoAcesso[0]->codigo_lotacao_fisica, $this->arrayGigad)) {
                    $lote = new LoteAmortizacaoLiquidacaoSIAF;
                    $loteAnterior = DB::table('TBL_SIAF_AMORTIZACOES')
                                        ->select('CO_PEDIDO', 'NO_CLIENTE', 'CO_CNPJ', 'CONTRATO_CAIXA', 'CONTRATO_BNDES', 'VL_AMORTIZADO', 'CONTA_CORRENTE', 'STATUS',
                                            DB::raw("(CASE WHEN TP_AMORTIZACAO = 'L' THEN 'LIQUIDACAO' WHEN TP_AMORTIZACAO = 'A' THEN 'AMORTIZACAO' END) AS TP_AMORTIZACAO"))
                                        ->where('DT_LT_AMORTIZADOR', '=', $lote->getDataLoteAtual())
                                        ->where('CO_GIGAD', '=', $empregadoAcesso[0]->codigo_lotacao_fisica)
                                        ->get();        
                    return json_encode($loteAnterior, JSON_UNESCAPED_SLASHES);
                } elseif (in_array($empregadoAcesso[0]->codigo_lotacao_fisica, $this->arraySR)) {
                    $lote = new LoteAmortizacaoLiquidacaoSIAF;       
                    $loteAnterior = DB::table('TBL_SIAF_AMORTIZACOES')
                                        ->select('CO_PEDIDO', 'NO_CLIENTE', 'CO_CNPJ', 'CONTRATO_CAIXA', 'CONTRATO_BNDES', 'VL_AMORTIZADO', 'CONTA_CORRENTE', 'STATUS',
                                            DB::raw("(CASE WHEN TP_AMORTIZACAO = 'L' THEN 'LIQUIDACAO' WHEN TP_AMORTIZACAO = 'A' THEN 'AMORTIZACAO' END) AS TP_AMORTIZACAO"))
                                        ->where('DT_LT_AMORTIZADOR', '=', $lote->getDataLoteAtual())
                                        ->where('CO_SR', '=', $empregadoAcesso[0]->codigo_lotacao_fisica)
                                        ->get();       
                    return json_encode($loteAnterior, JSON_UNESCAPED_SLASHES);
                } else {
                    $lote = new LoteAmortizacaoLiquidacaoSIAF;       
                    $loteAnterior = DB::table('TBL_SIAF_AMORTIZACOES')
                                        ->select('CO_PEDIDO', 'NO_CLIENTE', 'CO_CNPJ', 'CONTRATO_CAIXA', 'CONTRATO_BNDES', 'VL_AMORTIZADO', 'CONTA_CORRENTE', 'STATUS',
                                            DB::raw("(CASE WHEN TP_AMORTIZACAO = 'L' THEN 'LIQUIDACAO' WHEN TP_AMORTIZACAO = 'A' THEN 'AMORTIZACAO' END) AS TP_AMORTIZACAO"))
                                        ->where('DT_LT_AMORTIZADOR', '=', $lote->getDataLoteAtual())
                                        ->where('CO_PA', '=', $empregadoAcesso[0]->codigo_lotacao_fisica)
                                        ->get();        
                    return json_encode($loteAnterior, JSON_UNESCAPED_SLASHES);
                }
                break;
            default:
            $lote = new LoteAmortizacaoLiquidacaoSIAF;       
            $loteAnterior = DB::table('TBL_SIAF_AMORTIZACOES')
                                ->select('CO_PEDIDO', 'NO_CLIENTE', 'CO_CNPJ', 'CONTRATO_CAIXA', 'CONTRATO_BNDES', 'VL_AMORTIZADO', 'CONTA_CORRENTE', 'STATUS',
                                    DB::raw("(CASE WHEN TP_AMORTIZACAO = 'L' THEN 'LIQUIDACAO' WHEN TP_AMORTIZACAO = 'A' THEN 'AMORTIZACAO' END) AS TP_AMORTIZACAO"))
                                ->where('DT_LT_AMORTIZADOR', '=', $lote->getDataLoteAtual())
                                ->get();
            return json_encode($loteAnterior, JSON_UNESCAPED_SLASHES);
                break;
        }
    }

    public function contratosNaSumep()
    {
        $usuario = new Ldap;
        $empregado = Empregados::find($usuario->getMatricula());
        $empregadoAcesso = DB::table('tbl_empregados')
                            ->join('tbl_acessa_empregado', 'tbl_empregados.matricula', '=', 'tbl_acessa_empregado.matricula')
                            ->select('tbl_empregados.*', 'tbl_acessa_empregado.nivel_acesso')
                            // ->select('tbl_empregados.matricula', 'tbl_empregados.nome_completo', 'tbl_empregados.nome_funcao', 'tbl_empregados.codigo_lotacao_administrativa',  'tbl_acessa_empregado.nivel_acesso')
                            ->where('tbl_acessa_empregado.matricula', '=', $usuario->getMatricula())
                            ->get();
        
        switch ($empregadoAcesso[0]->nivel_acesso) {
            case 'EMPREGADO_AG':
                if ($empregadoAcesso[0]->codigo_lotacao_fisica === null) {
                    $contratosSumep = DB::table('TBL_SIAF_AMORTIZACOES')
                                            ->select('CO_PEDIDO', 'NO_CLIENTE', 'CONTRATO_CAIXA', 'CONTRATO_BNDES', 'VL_AMORTIZADO', 'DT_LT_AMORTIZADOR', 'STATUS', 
                                                    DB::raw("(CASE WHEN TP_AMORTIZACAO = 'L' THEN 'LIQUIDACAO' WHEN TP_AMORTIZACAO = 'A' THEN 'AMORTIZACAO' END) AS TP_AMORTIZACAO"))
                                            ->where('STATUS', 'like', '%SUMEP%')
                                            ->where('CO_PA', '=', $empregadoAcesso[0]->codigo_lotacao_administrativa)              
                                            ->get();      
                        return json_encode($contratosSumep, JSON_UNESCAPED_SLASHES);
                } else {
                    if (in_array($empregadoAcesso[0]->codigo_lotacao_fisica, $this->arrayGigad)) {
                        $contratosSumep = DB::table('TBL_SIAF_AMORTIZACOES')
                                            ->select('CO_PEDIDO', 'NO_CLIENTE', 'CONTRATO_CAIXA', 'CONTRATO_BNDES', 'VL_AMORTIZADO', 'DT_LT_AMORTIZADOR', 'STATUS', 
                                                    DB::raw("(CASE WHEN TP_AMORTIZACAO = 'L' THEN 'LIQUIDACAO' WHEN TP_AMORTIZACAO = 'A' THEN 'AMORTIZACAO' END) AS TP_AMORTIZACAO"))
                                            ->where('STATUS', 'like', '%SUMEP%')
                                            ->where('CO_GIGAD', '=', $empregadoAcesso[0]->codigo_lotacao_fisica)              
                                            ->get();;       
                        return json_encode($contratosSumep, JSON_UNESCAPED_SLASHES);
                    } elseif (in_array($empregadoAcesso[0]->codigo_lotacao_fisica, $this->arraySR)) {
                        $contratosSumep = DB::table('TBL_SIAF_AMORTIZACOES')
                                            ->select('CO_PEDIDO', 'NO_CLIENTE', 'CONTRATO_CAIXA', 'CONTRATO_BNDES', 'VL_AMORTIZADO', 'DT_LT_AMORTIZADOR', 'STATUS', 
                                                    DB::raw("(CASE WHEN TP_AMORTIZACAO = 'L' THEN 'LIQUIDACAO' WHEN TP_AMORTIZACAO = 'A' THEN 'AMORTIZACAO' END) AS TP_AMORTIZACAO"))
                                            ->where('STATUS', 'like', '%SUMEP%')
                                            ->where('CO_SR', '=', $empregadoAcesso[0]->codigo_lotacao_fisica)               
                                            ->get();;       
                        return json_encode($contratosSumep, JSON_UNESCAPED_SLASHES);
                    } else {
                        $contratosSumep = DB::table('TBL_SIAF_AMORTIZACOES')
                                            ->select('CO_PEDIDO', 'NO_CLIENTE', 'CONTRATO_CAIXA', 'CONTRATO_BNDES', 'VL_AMORTIZADO', 'DT_LT_AMORTIZADOR', 'STATUS', 
                                                    DB::raw("(CASE WHEN TP_AMORTIZACAO = 'L' THEN 'LIQUIDACAO' WHEN TP_AMORTIZACAO = 'A' THEN 'AMORTIZACAO' END) AS TP_AMORTIZACAO"))
                                            ->where('STATUS', 'like', '%SUMEP%')
                                            ->where('CO_PA', '=', $empregadoAcesso[0]->codigo_lotacao_fisica)               
                                            ->get();;       
                        return json_encode($contratosSumep, JSON_UNESCAPED_SLASHES);
                    }                   
                }
                break;
            case 'EMPREGADO_SR':
                if ($empregadoAcesso[0]->codigo_lotacao_fisica === null) {
                    $contratosSumep = DB::table('TBL_SIAF_AMORTIZACOES')
                                            ->select('CO_PEDIDO', 'NO_CLIENTE', 'CONTRATO_CAIXA', 'CONTRATO_BNDES', 'VL_AMORTIZADO', 'DT_LT_AMORTIZADOR', 'STATUS', 
                                                    DB::raw("(CASE WHEN TP_AMORTIZACAO = 'L' THEN 'LIQUIDACAO' WHEN TP_AMORTIZACAO = 'A' THEN 'AMORTIZACAO' END) AS TP_AMORTIZACAO"))
                                            ->where('STATUS', 'like', '%SUMEP%')
                                            ->where('CO_SR', '=', $empregadoAcesso[0]->codigo_lotacao_administrativa)               
                                            ->get();;       
                    return json_encode($contratosSumep, JSON_UNESCAPED_SLASHES);
                } else {
                    if (in_array($empregadoAcesso[0]->codigo_lotacao_fisica, $this->arrayGigad)) {
                        $contratosSumep = DB::table('TBL_SIAF_AMORTIZACOES')
                                            ->select('CO_PEDIDO', 'NO_CLIENTE', 'CONTRATO_CAIXA', 'CONTRATO_BNDES', 'VL_AMORTIZADO', 'DT_LT_AMORTIZADOR', 'STATUS', 
                                                    DB::raw("(CASE WHEN TP_AMORTIZACAO = 'L' THEN 'LIQUIDACAO' WHEN TP_AMORTIZACAO = 'A' THEN 'AMORTIZACAO' END) AS TP_AMORTIZACAO"))
                                            ->where('STATUS', 'like', '%SUMEP%')
                                            ->where('CO_GIGAD', '=', $empregadoAcesso[0]->codigo_lotacao_fisica)                
                                            ->get();;       
                        return json_encode($contratosSumep, JSON_UNESCAPED_SLASHES);
                    } elseif (in_array($empregadoAcesso[0]->codigo_lotacao_fisica, $this->arraySR)) {
                        $contratosSumep = DB::table('TBL_SIAF_AMORTIZACOES')
                                            ->select('CO_PEDIDO', 'NO_CLIENTE', 'CONTRATO_CAIXA', 'CONTRATO_BNDES', 'VL_AMORTIZADO', 'DT_LT_AMORTIZADOR', 'STATUS', 
                                                    DB::raw("(CASE WHEN TP_AMORTIZACAO = 'L' THEN 'LIQUIDACAO' WHEN TP_AMORTIZACAO = 'A' THEN 'AMORTIZACAO' END) AS TP_AMORTIZACAO"))
                                            ->where('STATUS', 'like', '%SUMEP%')
                                            ->where('CO_SR', '=', $empregadoAcesso[0]->codigo_lotacao_fisica)                   
                                            ->get();;       
                        return json_encode($contratosSumep, JSON_UNESCAPED_SLASHES);
                    } else {
                        $contratosSumep = DB::table('TBL_SIAF_AMORTIZACOES')
                                            ->select('CO_PEDIDO', 'NO_CLIENTE', 'CONTRATO_CAIXA', 'CONTRATO_BNDES', 'VL_AMORTIZADO', 'DT_LT_AMORTIZADOR', 'STATUS', 
                                                    DB::raw("(CASE WHEN TP_AMORTIZACAO = 'L' THEN 'LIQUIDACAO' WHEN TP_AMORTIZACAO = 'A' THEN 'AMORTIZACAO' END) AS TP_AMORTIZACAO"))
                                            ->where('STATUS', 'like', '%SUMEP%')
                                            ->where('CO_PA', '=', $empregadoAcesso[0]->codigo_lotacao_fisica)                      
                                            ->get();;       
                        return json_encode($contratosSumep, JSON_UNESCAPED_SLASHES);
                    }                   
                }
                break;
            case 'GIGAD':
                if ($empregadoAcesso[0]->codigo_lotacao_fisica === null) {
                    $contratosSumep = DB::table('TBL_SIAF_AMORTIZACOES')
                                            ->select('CO_PEDIDO', 'NO_CLIENTE', 'CONTRATO_CAIXA', 'CONTRATO_BNDES', 'VL_AMORTIZADO', 'DT_LT_AMORTIZADOR', 'STATUS', 
                                                    DB::raw("(CASE WHEN TP_AMORTIZACAO = 'L' THEN 'LIQUIDACAO' WHEN TP_AMORTIZACAO = 'A' THEN 'AMORTIZACAO' END) AS TP_AMORTIZACAO"))
                                            ->where('STATUS', 'like', '%SUMEP%')
                                            ->where('CO_GIGAD', '=', $empregadoAcesso[0]->codigo_lotacao_administrativa)                       
                                            ->get();;       
                    return json_encode($contratosSumep, JSON_UNESCAPED_SLASHES);
                } else {
                    if (in_array($empregadoAcesso[0]->codigo_lotacao_fisica, $this->arrayGigad)) {
                        $contratosSumep = DB::table('TBL_SIAF_AMORTIZACOES')
                                            ->select('CO_PEDIDO', 'NO_CLIENTE', 'CONTRATO_CAIXA', 'CONTRATO_BNDES', 'VL_AMORTIZADO', 'DT_LT_AMORTIZADOR', 'STATUS', 
                                                    DB::raw("(CASE WHEN TP_AMORTIZACAO = 'L' THEN 'LIQUIDACAO' WHEN TP_AMORTIZACAO = 'A' THEN 'AMORTIZACAO' END) AS TP_AMORTIZACAO"))
                                            ->where('STATUS', 'like', '%SUMEP%')
                                            ->where('CO_GIGAD', '=', $empregadoAcesso[0]->codigo_lotacao_fisica)                        
                                            ->get();;       
                        return json_encode($contratosSumep, JSON_UNESCAPED_SLASHES);
                    } elseif (in_array($empregadoAcesso[0]->codigo_lotacao_fisica, $this->arraySR)) {
                        $contratosSumep = DB::table('TBL_SIAF_AMORTIZACOES')
                                            ->select('CO_PEDIDO', 'NO_CLIENTE', 'CONTRATO_CAIXA', 'CONTRATO_BNDES', 'VL_AMORTIZADO', 'DT_LT_AMORTIZADOR', 'STATUS', 
                                                    DB::raw("(CASE WHEN TP_AMORTIZACAO = 'L' THEN 'LIQUIDACAO' WHEN TP_AMORTIZACAO = 'A' THEN 'AMORTIZACAO' END) AS TP_AMORTIZACAO"))
                                            ->where('STATUS', 'like', '%SUMEP%')
                                            ->where('CO_SR', '=', $empregadoAcesso[0]->codigo_lotacao_fisica)                          
                                            ->get();;       
                        return json_encode($contratosSumep, JSON_UNESCAPED_SLASHES); 
                    } else {      
                        $contratosSumep = DB::table('TBL_SIAF_AMORTIZACOES')
                                            ->select('CO_PEDIDO', 'NO_CLIENTE', 'CONTRATO_CAIXA', 'CONTRATO_BNDES', 'VL_AMORTIZADO', 'DT_LT_AMORTIZADOR', 'STATUS', 
                                                    DB::raw("(CASE WHEN TP_AMORTIZACAO = 'L' THEN 'LIQUIDACAO' WHEN TP_AMORTIZACAO = 'A' THEN 'AMORTIZACAO' END) AS TP_AMORTIZACAO"))
                                            ->where('STATUS', 'like', '%SUMEP%')
                                            ->where('CO_PA', '=', $empregadoAcesso[0]->codigo_lotacao_fisica)
                                            ->get();;       
                        return json_encode($contratosSumep, JSON_UNESCAPED_SLASHES);  
                    }                   
                }
                break;
            default:
            $contratosSumep = DB::table('TBL_SIAF_AMORTIZACOES')
                                ->select('CO_PEDIDO', 'NO_CLIENTE', 'CONTRATO_CAIXA', 'CONTRATO_BNDES', 'VL_AMORTIZADO', 'DT_LT_AMORTIZADOR', 'STATUS', 
                                        DB::raw("(CASE WHEN TP_AMORTIZACAO = 'L' THEN 'LIQUIDACAO' WHEN TP_AMORTIZACAO = 'A' THEN 'AMORTIZACAO' END) AS TP_AMORTIZACAO"))
                                ->where('STATUS', 'like', '%SUMEP%')
                                ->get();
            return json_encode($contratosSumep, JSON_UNESCAPED_SLASHES);
                break;
        }
    }

    function contratosParaLiquidar(){
        $contratosSumep = DB::table('TBL_SIAF_AMORTIZACOES')
                                ->select('CONTRATO_CAIXA', 'NO_CLIENTE', 'CO_CNPJ')
                                ->get();
            return json_encode($contratosSumep, JSON_UNESCAPED_SLASHES);
    }
}
