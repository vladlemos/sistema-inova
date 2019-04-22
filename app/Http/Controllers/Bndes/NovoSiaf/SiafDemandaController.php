<?php

namespace App\Http\Controllers\Bndes\NovoSiaf;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Bndes\NovoSiaf\SiafDemanda;
use App\Models\Bndes\NovoSiaf\SiafHistoricoDemanda;
use App\Http\Controllers\Bndes\NovoSiaf\SiafHistoricoDemandaController;
use App\Classes\Bndes\NovoSiaf\LoteAmortizacaoLiquidacaoSIAF;
use App\Models\Bndes\NovoSiaf\SiafContrato;
use App\Classes\Geral\Ldap;
use App\Empregado;
use App\AcessaEmpregado;
use App\Http\Controllers\Sistemas\EmpregadoController;

class SiafDemandaController extends Controller
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
     * @param  App\Models\Bndes\NovoSiaf\SiafDemanda  $siafDemanda
     * @return \Illuminate\Http\Response
     */
    public function show($demanda)
    {
        $dadosDemanda = DB::table('TBL_SIAF_DEMANDAS')
                            ->select('TBL_SIAF_DEMANDAS.codigoDemanda', 'TBL_SIAF_DEMANDAS.nomeCliente', 'TBL_SIAF_DEMANDAS.cnpj', 'TBL_SIAF_DEMANDAS.contratoCaixa', 'TBL_SIAF_DEMANDAS.contratoBndes', 'TBL_SIAF_DEMANDAS.valorOperacao', 'TBL_SIAF_DEMANDAS.contaDebito', 'TBL_SIAF_DEMANDAS.status', 'TBL_SIAF_DEMANDAS.codigoPa', 'TBL_SIAF_DEMANDAS.codigoSr', 'TBL_SIAF_DEMANDAS.codigoGigad', 
                                DB::raw("(CASE WHEN tipoOperacao = 'L' THEN 'LIQUIDACAO' WHEN tipoOperacao = 'A' THEN 'AMORTIZACAO' END) AS tipoOperacao"))
                            ->where('TBL_SIAF_DEMANDAS.codigoDemanda', '=', $demanda)
                            ->get();
        if (isset($dadosDemanda)) {
            return json_encode($dadosDemanda, JSON_UNESCAPED_SLASHES);
        } else{
            return response('Demanda não encontrada', 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\Bndes\NovoSiaf\SiafDemanda  $siafDemanda
     * @return \Illuminate\Http\Response
     */
    public function edit(SiafDemanda $siafDemanda)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $arrayHistorico = [];

        // Update na tabela TBL_SIAF_DEMANDAS
        $demanda = SiafDemanda::find($id);
        $demanda->contratoBndes = '64199941238';
        $demanda->contaDebito = '1234.567.8901234-5';
        $demanda->valorOperacao = '1234.56';
        $demanda->tipoOperacao = 'L';
        $demanda->status = 'CANCELADO';
        // $demanda->save();

        // Capturar os dados do usuário da sessão
        $usuario = Empregado::find(substr($_SERVER["LOGON_USER"],strpos($_SERVER["LOGON_USER"], "\\")+1));
        
        // Insert na tabela TBL_SIAF_HISTORICO_DEMANDAS
        $historicoDemanda = new SiafHistoricoDemanda;
        $historicoDemanda->contratoCaixa = $demanda->contratoCaixa;
        $historicoDemanda->loteAmortizacao = $demanda->loteAmortizacao;
        $historicoDemanda->tipoHistorico = $demanda->status;
        $historicoDemanda->historico = $demanda->historicoContrato;
        $historicoDemanda->matriculaResponsavel = $usuario->matriculaResponsavel;
        $historicoDemanda->unidadeResponsavel = $usuario->codigoLotacaoAdministrativa;
        // $historicoDemanda->save();

        // Retorna os dados da demanda atualizada/cadastrada via json
        $historicoDemandaCadastrada = SiafHistoricoDemanda::find($historicoDemanda->codigoHistorico);

        $arrayHistoricoDemanda = array(
            "codigoHistorico" => $historicoDemandaCadastrada->codigoHistorico, 
            "dataHistorico" => $historicoDemandaCadastrada->created_at->format('d/m/Y H:i:s'),
            "statusHistorico" => $historicoDemandaCadastrada->tipoHistorico,
            "matriculaResponsavel" => $historicoDemandaCadastrada->matriculaResponsavel,
            "unidadeResponsavel" => str_pad($historicoDemandaCadastrada->unidadeResponsavel, 4, '0', STR_PAD_LEFT),
            "observacaoHistorico" => utf8_decode($historicoDemandaCadastrada->historico)
        );
    
        $arrayDemanda = array(
            "contratoBndes" => $demanda->contratoBndes,
            "contaDebito" => $demanda->contaDebito,
            "valorOperacao" => $demanda->valorOperacao,
            "tipoOperacao" => $demanda->tipoOperacao,
            "status" => $demanda->status,
            "historicoDemanda" => $arrayHistoricoDemanda
        );
        
        return json_encode($arrayDemanda, JSON_UNESCAPED_SLASHES);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Bndes\NovoSiaf\SiafDemanda  $siafDemanda
     * @return \Illuminate\Http\Response
     */
    public function destroy(SiafDemanda $siafDemanda)
    {
        //
    }

    public function loteAnterior()
    {
        $usuario = new Ldap;
        $empregado = Empregado::find($usuario->getMatricula());
        $empregadoAcesso = DB::table('tbl_EMPREGADOS')
                            ->join('tbl_ACESSA_EMPREGADOS', 'tbl_EMPREGADOS.matricula', '=', 'tbl_ACESSA_EMPREGADOS.matricula')
                            ->select('tbl_EMPREGADOS.*', 'tbl_ACESSA_EMPREGADOS.nivelAcesso')
                            ->where('tbl_ACESSA_EMPREGADOS.matricula', '=', $empregado->matricula)
                            ->get();
        $lote = new LoteAmortizacaoLiquidacaoSIAF; 
        switch ($empregadoAcesso[0]->nivelAcesso) {
            case 'EMPREGADO_AG':
                if ($empregadoAcesso[0]->codigoLotacaoFisica === null) {      
                    $loteAnterior = DB::table('TBL_SIAF_DEMANDAS')
                                        ->select('codigoDemanda', 'nomeCliente', 'cnpj', 'contratoCaixa', 'contratoBndes', 'valorOperacao', 'contaDebito', 'status',
                                            DB::raw("(CASE WHEN tipoOperacao = 'L' THEN 'LIQUIDACAO' WHEN tipoOperacao = 'A' THEN 'AMORTIZACAO' END) AS tipoOperacao"))
                                        ->where('codigoPa', '=', $empregadoAcesso[0]->codigoLotacaoAdministrativa)
                                        ->where('dataLote', '=', $lote->getDataLoteAnterior())             
                                        ->get(); 
                    return json_encode($loteAnterior, JSON_UNESCAPED_SLASHES);
                } elseif (in_array($empregadoAcesso[0]->codigoLotacaoFisica, $this->arrayGigad)) {
                    $loteAnterior = DB::table('TBL_SIAF_DEMANDAS')
                                    ->select('codigoDemanda', 'nomeCliente', 'cnpj', 'contratoCaixa', 'contratoBndes', 'valorOperacao', 'contaDebito', 'status',
                                        DB::raw("(CASE WHEN tipoOperacao = 'L' THEN 'LIQUIDACAO' WHEN tipoOperacao = 'A' THEN 'AMORTIZACAO' END) AS tipoOperacao"))
                                    ->where('codigoGigad', '=', $empregadoAcesso[0]->codigoLotacaoFisica)
                                    ->where('dataLote', '=', $lote->getDataLoteAnterior())
                                    ->get();    
                    return json_encode($loteAnterior, JSON_UNESCAPED_SLASHES);
                } elseif (in_array($empregadoAcesso[0]->codigoLotacaoFisica, $this->arraySR)) {       
                    $loteAnterior = DB::table('TBL_SIAF_DEMANDAS')
                                    ->select('codigoDemanda', 'nomeCliente', 'cnpj', 'contratoCaixa', 'contratoBndes', 'valorOperacao', 'contaDebito', 'status',
                                        DB::raw("(CASE WHEN tipoOperacao = 'L' THEN 'LIQUIDACAO' WHEN tipoOperacao = 'A' THEN 'AMORTIZACAO' END) AS tipoOperacao"))
                                    ->where('codigoSr', '=', $empregadoAcesso[0]->codigoLotacaoFisica)
                                    ->where('dataLote', '=', $lote->getDataLoteAnterior())
                                    ->get();      
                    return json_encode($loteAnterior, JSON_UNESCAPED_SLASHES);
                } else {       
                    $loteAnterior = DB::table('TBL_SIAF_DEMANDAS')
                                    ->select('codigoDemanda', 'nomeCliente', 'cnpj', 'contratoCaixa', 'contratoBndes', 'valorOperacao', 'contaDebito', 'status',
                                        DB::raw("(CASE WHEN tipoOperacao = 'L' THEN 'LIQUIDACAO' WHEN tipoOperacao = 'A' THEN 'AMORTIZACAO' END) AS tipoOperacao"))
                                    ->where('codigoPa', '=', $empregadoAcesso[0]->codigoLotacaoFisica)
                                    ->where('dataLote', '=', $lote->getDataLoteAnterior())
                                    ->get();       
                    return json_encode($loteAnterior, JSON_UNESCAPED_SLASHES);
                }                   
                break;
            case 'EMPREGADO_SR':
                if ($empregadoAcesso[0]->codigoLotacaoFisica === null) {       
                    $loteAnterior = DB::table('TBL_SIAF_DEMANDAS')
                                    ->select('codigoDemanda', 'nomeCliente', 'cnpj', 'contratoCaixa', 'contratoBndes', 'valorOperacao', 'contaDebito', 'status',
                                        DB::raw("(CASE WHEN tipoOperacao = 'L' THEN 'LIQUIDACAO' WHEN tipoOperacao = 'A' THEN 'AMORTIZACAO' END) AS tipoOperacao"))
                                    ->where('codigoSr', '=', $empregadoAcesso[0]->codigoLotacaoAdministrativa)
                                    ->where('dataLote', '=', $lote->getDataLoteAnterior())
                                    ->get();       
                    return json_encode($loteAnterior, JSON_UNESCAPED_SLASHES);
                } elseif (in_array($empregadoAcesso[0]->codigoLotacaoFisica, $this->arrayGigad)) {
                    $loteAnterior = DB::table('TBL_SIAF_DEMANDAS')
                                    ->select('codigoDemanda', 'nomeCliente', 'cnpj', 'contratoCaixa', 'contratoBndes', 'valorOperacao', 'contaDebito', 'status',
                                        DB::raw("(CASE WHEN tipoOperacao = 'L' THEN 'LIQUIDACAO' WHEN tipoOperacao = 'A' THEN 'AMORTIZACAO' END) AS tipoOperacao"))
                                    ->where('codigoGigad', '=', $empregadoAcesso[0]->codigoLotacaoFisica)
                                    ->where('dataLote', '=', $lote->getDataLoteAnterior())
                                    ->get();      
                    return json_encode($loteAnterior, JSON_UNESCAPED_SLASHES);
                } elseif (in_array($empregadoAcesso[0]->codigoLotacaoFisica, $this->arraySR)) {     
                    $loteAnterior = DB::table('TBL_SIAF_DEMANDAS')
                                    ->select('codigoDemanda', 'nomeCliente', 'cnpj', 'contratoCaixa', 'contratoBndes', 'valorOperacao', 'contaDebito', 'status',
                                        DB::raw("(CASE WHEN tipoOperacao = 'L' THEN 'LIQUIDACAO' WHEN tipoOperacao = 'A' THEN 'AMORTIZACAO' END) AS tipoOperacao"))
                                    ->where('codigoSr', '=', $empregadoAcesso[0]->codigoLotacaoFisica)
                                    ->where('dataLote', '=', $lote->getDataLoteAnterior())
                                    ->get();     
                    return json_encode($loteAnterior, JSON_UNESCAPED_SLASHES);
                } else {       
                    $loteAnterior = DB::table('TBL_SIAF_DEMANDAS')
                                    ->select('codigoDemanda', 'nomeCliente', 'cnpj', 'contratoCaixa', 'contratoBndes', 'valorOperacao', 'contaDebito', 'status',
                                        DB::raw("(CASE WHEN tipoOperacao = 'L' THEN 'LIQUIDACAO' WHEN tipoOperacao = 'A' THEN 'AMORTIZACAO' END) AS tipoOperacao"))
                                    ->where('codigoPa', '=', $empregadoAcesso[0]->codigoLotacaoFisica)
                                    ->where('dataLote', '=', $lote->getDataLoteAnterior())
                                    ->get();      
                    return json_encode($loteAnterior, JSON_UNESCAPED_SLASHES);
                }                   
                break;
            case 'GIGAD':
                if ($empregadoAcesso[0]->codigoLotacaoFisica === null) {    
                    $loteAnterior = DB::table('TBL_SIAF_DEMANDAS')
                                    ->select('codigoDemanda', 'nomeCliente', 'cnpj', 'contratoCaixa', 'contratoBndes', 'valorOperacao', 'contaDebito', 'status',
                                        DB::raw("(CASE WHEN tipoOperacao = 'L' THEN 'LIQUIDACAO' WHEN tipoOperacao = 'A' THEN 'AMORTIZACAO' END) AS tipoOperacao"))
                                    ->where('codigoGigad', '=', $empregadoAcesso[0]->codigoLotacaoAdministrativa)
                                    ->where('dataLote', '=', $lote->getDataLoteAnterior())
                                    ->get();    
                    return json_encode($loteAnterior, JSON_UNESCAPED_SLASHES);
                } elseif (in_array($empregadoAcesso[0]->codigoLotacaoFisica, $this->arrayGigad)) {
                    $loteAnterior = DB::table('TBL_SIAF_DEMANDAS')
                                    ->select('codigoDemanda', 'nomeCliente', 'cnpj', 'contratoCaixa', 'contratoBndes', 'valorOperacao', 'contaDebito', 'status',
                                        DB::raw("(CASE WHEN tipoOperacao = 'L' THEN 'LIQUIDACAO' WHEN tipoOperacao = 'A' THEN 'AMORTIZACAO' END) AS tipoOperacao"))
                                    ->where('codigoGigad', '=', $empregadoAcesso[0]->codigoLotacaoFisica)
                                    ->where('dataLote', '=', $lote->getDataLoteAnterior())
                                    ->get();        
                    return json_encode($loteAnterior, JSON_UNESCAPED_SLASHES);
                } elseif (in_array($empregadoAcesso[0]->codigoLotacaoFisica, $this->arraySR)) {      
                    $loteAnterior = DB::table('TBL_SIAF_DEMANDAS')
                                    ->select('codigoDemanda', 'nomeCliente', 'cnpj', 'contratoCaixa', 'contratoBndes', 'valorOperacao', 'contaDebito', 'status',
                                        DB::raw("(CASE WHEN tipoOperacao = 'L' THEN 'LIQUIDACAO' WHEN tipoOperacao = 'A' THEN 'AMORTIZACAO' END) AS tipoOperacao"))
                                    ->where('codigoSr', '=', $empregadoAcesso[0]->codigoLotacaoFisica)
                                    ->where('dataLote', '=', $lote->getDataLoteAnterior())
                                    ->get();      
                    return json_encode($loteAnterior, JSON_UNESCAPED_SLASHES);
                } else {      
                    $loteAnterior = DB::table('TBL_SIAF_DEMANDAS')
                                    ->select('codigoDemanda', 'nomeCliente', 'cnpj', 'contratoCaixa', 'contratoBndes', 'valorOperacao', 'contaDebito', 'status',
                                        DB::raw("(CASE WHEN tipoOperacao = 'L' THEN 'LIQUIDACAO' WHEN tipoOperacao = 'A' THEN 'AMORTIZACAO' END) AS tipoOperacao"))
                                    ->where('codigoPa', '=', $empregadoAcesso[0]->codigoLotacaoFisica)
                                    ->where('dataLote', '=', $lote->getDataLoteAnterior())
                                    ->get();       
                    return json_encode($loteAnterior, JSON_UNESCAPED_SLASHES);
                }
                break;
            default:     
            $loteAnterior = DB::table('TBL_SIAF_DEMANDAS')
                                ->select('codigoDemanda', 'nomeCliente', 'cnpj', 'contratoCaixa', 'contratoBndes', 'valorOperacao', 'contaDebito', 'status',
                                    DB::raw("(CASE WHEN tipoOperacao = 'L' THEN 'LIQUIDACAO' WHEN tipoOperacao = 'A' THEN 'AMORTIZACAO' END) AS tipoOperacao"))
                                ->where('dataLote', '=', $lote->getDataLoteAnterior())
                                ->get();
            return json_encode($loteAnterior, JSON_UNESCAPED_SLASHES);
                break;
        }
    }

    public function loteAtual()
    {
        $usuario = new Ldap;
        $empregado = Empregado::find($usuario->getMatricula());
        $empregadoAcesso = DB::table('tbl_EMPREGADOS')
                            ->join('tbl_ACESSA_EMPREGADOS', 'tbl_EMPREGADOS.matricula', '=', 'tbl_ACESSA_EMPREGADOS.matricula')
                            ->select('tbl_EMPREGADOS.*', 'tbl_ACESSA_EMPREGADOS.nivelAcesso')
                            ->where('tbl_ACESSA_EMPREGADOS.matricula', '=', $empregado->matricula)
                            ->get();
        $lote = new LoteAmortizacaoLiquidacaoSIAF;
        switch ($empregadoAcesso[0]->nivelAcesso) {
            case 'EMPREGADO_AG':
                if ($empregadoAcesso[0]->codigoLotacaoFisica === null) {
                    $loteAnterior = DB::table('TBL_SIAF_DEMANDAS')
                                        ->select('codigoDemanda', 'nomeCliente', 'cnpj', 'contratoCaixa', 'contratoBndes', 'valorOperacao', 'contaDebito', 'status',
                                            DB::raw("(CASE WHEN tipoOperacao = 'L' THEN 'LIQUIDACAO' WHEN tipoOperacao = 'A' THEN 'AMORTIZACAO' END) AS tipoOperacao"))
                                        ->where('dataLote', '=', $lote->getDataLoteAtual())
                                        ->where('codigoPa', '=', $empregadoAcesso[0]->codigoLotacaoAdministrativa)
                                        ->get();       
                    return json_encode($loteAnterior, JSON_UNESCAPED_SLASHES);
                } elseif (in_array($empregadoAcesso[0]->codigoLotacaoFisica, $this->arrayGigad)) {
                    $loteAnterior = DB::table('TBL_SIAF_DEMANDAS')
                                    ->select('codigoDemanda', 'nomeCliente', 'cnpj', 'contratoCaixa', 'contratoBndes', 'valorOperacao', 'contaDebito', 'status',
                                        DB::raw("(CASE WHEN tipoOperacao = 'L' THEN 'LIQUIDACAO' WHEN tipoOperacao = 'A' THEN 'AMORTIZACAO' END) AS tipoOperacao"))
                                    ->where('dataLote', '=', $lote->getDataLoteAtual())
                                    ->where('codigoGigad', '=', $empregadoAcesso[0]->codigoLotacaoFisica)
                                    ->get();        
                    return json_encode($loteAnterior, JSON_UNESCAPED_SLASHES);
                } elseif (in_array($empregadoAcesso[0]->codigoLotacaoFisica, $this->arraySR)) {
                    $loteAnterior = DB::table('TBL_SIAF_DEMANDAS')
                                    ->select('codigoDemanda', 'nomeCliente', 'cnpj', 'contratoCaixa', 'contratoBndes', 'valorOperacao', 'contaDebito', 'status',
                                        DB::raw("(CASE WHEN tipoOperacao = 'L' THEN 'LIQUIDACAO' WHEN tipoOperacao = 'A' THEN 'AMORTIZACAO' END) AS tipoOperacao"))
                                    ->where('dataLote', '=', $lote->getDataLoteAtual())
                                    ->where('codigoSr', '=', $empregadoAcesso[0]->codigoLotacaoFisica)
                                    ->get();         
                    return json_encode($loteAnterior, JSON_UNESCAPED_SLASHES);
                } else {
                    $loteAnterior = DB::table('TBL_SIAF_DEMANDAS')
                                    ->select('codigoDemanda', 'nomeCliente', 'cnpj', 'contratoCaixa', 'contratoBndes', 'valorOperacao', 'contaDebito', 'status',
                                        DB::raw("(CASE WHEN tipoOperacao = 'L' THEN 'LIQUIDACAO' WHEN tipoOperacao = 'A' THEN 'AMORTIZACAO' END) AS tipoOperacao"))
                                    ->where('dataLote', '=', $lote->getDataLoteAtual())
                                    ->where('codigoPa', '=', $empregadoAcesso[0]->codigoLotacaoFisica)
                                    ->get();        
                    return json_encode($loteAnterior, JSON_UNESCAPED_SLASHES);
                }
                break;
            case 'EMPREGADO_SR':
                if ($empregadoAcesso[0]->codigoLotacaoFisica === null) {      
                    $loteAnterior = DB::table('TBL_SIAF_DEMANDAS')
                                        ->select('codigoDemanda', 'nomeCliente', 'cnpj', 'contratoCaixa', 'contratoBndes', 'valorOperacao', 'contaDebito', 'status',
                                            DB::raw("(CASE WHEN tipoOperacao = 'L' THEN 'LIQUIDACAO' WHEN tipoOperacao = 'A' THEN 'AMORTIZACAO' END) AS tipoOperacao"))
                                        ->where('dataLote', '=', $lote->getDataLoteAtual())
                                        ->where('codigoSr', '=', $empregadoAcesso[0]->codigoLotacaoAdministrativa)
                                        ->get();       
                    return json_encode($loteAnterior, JSON_UNESCAPED_SLASHES);
                } else {
                    if (in_array($empregadoAcesso[0]->codigoLotacaoFisica, $this->arrayGigad)) {
                        $loteAnterior = DB::table('TBL_SIAF_DEMANDAS')
                                        ->select('codigoDemanda', 'nomeCliente', 'cnpj', 'contratoCaixa', 'contratoBndes', 'valorOperacao', 'contaDebito', 'status',
                                            DB::raw("(CASE WHEN tipoOperacao = 'L' THEN 'LIQUIDACAO' WHEN tipoOperacao = 'A' THEN 'AMORTIZACAO' END) AS tipoOperacao"))
                                        ->where('dataLote', '=', $lote->getDataLoteAtual())
                                        ->where('codigoGigad', '=', $empregadoAcesso[0]->codigoLotacaoFisica)
                                        ->get();        
                        return json_encode($loteAnterior, JSON_UNESCAPED_SLASHES);
                    } elseif (in_array($empregadoAcesso[0]->codigoLotacaoFisica, $this->arraySR)) {      
                        $loteAnterior = DB::table('TBL_SIAF_DEMANDAS')
                                        ->select('codigoDemanda', 'nomeCliente', 'cnpj', 'contratoCaixa', 'contratoBndes', 'valorOperacao', 'contaDebito', 'status',
                                            DB::raw("(CASE WHEN tipoOperacao = 'L' THEN 'LIQUIDACAO' WHEN tipoOperacao = 'A' THEN 'AMORTIZACAO' END) AS tipoOperacao"))
                                        ->where('dataLote', '=', $lote->getDataLoteAtual())
                                        ->where('codigoSr', '=', $empregadoAcesso[0]->codigoLotacaoFisica)
                                        ->get();      
                        return json_encode($loteAnterior, JSON_UNESCAPED_SLASHES);
                    } else {       
                        $loteAnterior = DB::table('TBL_SIAF_DEMANDAS')
                                        ->select('codigoDemanda', 'nomeCliente', 'cnpj', 'contratoCaixa', 'contratoBndes', 'valorOperacao', 'contaDebito', 'status',
                                            DB::raw("(CASE WHEN tipoOperacao = 'L' THEN 'LIQUIDACAO' WHEN tipoOperacao = 'A' THEN 'AMORTIZACAO' END) AS tipoOperacao"))
                                        ->where('dataLote', '=', $lote->getDataLoteAtual())
                                        ->where('codigoPa', '=', $empregadoAcesso[0]->codigoLotacaoFisica)
                                        ->get();       
                        return json_encode($loteAnterior, JSON_UNESCAPED_SLASHES);
                    }                   
                }
                break;
            case 'GIGAD':
                if ($empregadoAcesso[0]->codigoLotacaoFisica === null) {      
                    $loteAnterior = DB::table('TBL_SIAF_DEMANDAS')
                                        ->select('codigoDemanda', 'nomeCliente', 'cnpj', 'contratoCaixa', 'contratoBndes', 'valorOperacao', 'contaDebito', 'status',
                                            DB::raw("(CASE WHEN tipoOperacao = 'L' THEN 'LIQUIDACAO' WHEN tipoOperacao = 'A' THEN 'AMORTIZACAO' END) AS tipoOperacao"))
                                        ->where('dataLote', '=', $lote->getDataLoteAtual())
                                        ->where('codigoGigad', '=', $empregadoAcesso[0]->codigoLotacaoAdministrativa)
                                        ->get();   
                    return json_encode($loteAnterior, JSON_UNESCAPED_SLASHES);
                } elseif (in_array($empregadoAcesso[0]->codigoLotacaoFisica, $this->arrayGigad)) {
                    $loteAnterior = DB::table('TBL_SIAF_DEMANDAS')
                                        ->select('codigoDemanda', 'nomeCliente', 'cnpj', 'contratoCaixa', 'contratoBndes', 'valorOperacao', 'contaDebito', 'status',
                                            DB::raw("(CASE WHEN tipoOperacao = 'L' THEN 'LIQUIDACAO' WHEN tipoOperacao = 'A' THEN 'AMORTIZACAO' END) AS tipoOperacao"))
                                        ->where('dataLote', '=', $lote->getDataLoteAtual())
                                        ->where('codigoGigad', '=', $empregadoAcesso[0]->codigoLotacaoFisica)
                                        ->get();        
                    return json_encode($loteAnterior, JSON_UNESCAPED_SLASHES);
                } elseif (in_array($empregadoAcesso[0]->codigoLotacaoFisica, $this->arraySR)) {       
                    $loteAnterior = DB::table('TBL_SIAF_DEMANDAS')
                                        ->select('codigoDemanda', 'nomeCliente', 'cnpj', 'contratoCaixa', 'contratoBndes', 'valorOperacao', 'contaDebito', 'status',
                                            DB::raw("(CASE WHEN tipoOperacao = 'L' THEN 'LIQUIDACAO' WHEN tipoOperacao = 'A' THEN 'AMORTIZACAO' END) AS tipoOperacao"))
                                        ->where('dataLote', '=', $lote->getDataLoteAtual())
                                        ->where('codigoSr', '=', $empregadoAcesso[0]->codigoLotacaoFisica)
                                        ->get();       
                    return json_encode($loteAnterior, JSON_UNESCAPED_SLASHES);
                } else {      
                    $loteAnterior = DB::table('TBL_SIAF_DEMANDAS')
                                        ->select('codigoDemanda', 'nomeCliente', 'cnpj', 'contratoCaixa', 'contratoBndes', 'valorOperacao', 'contaDebito', 'status',
                                            DB::raw("(CASE WHEN tipoOperacao = 'L' THEN 'LIQUIDACAO' WHEN tipoOperacao = 'A' THEN 'AMORTIZACAO' END) AS tipoOperacao"))
                                        ->where('dataLote', '=', $lote->getDataLoteAtual())
                                        ->where('codigoPa', '=', $empregadoAcesso[0]->codigoLotacaoFisica)
                                        ->get();        
                    return json_encode($loteAnterior, JSON_UNESCAPED_SLASHES);
                }
                break;
            default:     
            $loteAnterior = DB::table('TBL_SIAF_DEMANDAS')
                                ->select('codigoDemanda', 'nomeCliente', 'cnpj', 'contratoCaixa', 'contratoBndes', 'valorOperacao', 'contaDebito', 'status',
                                    DB::raw("(CASE WHEN tipoOperacao = 'L' THEN 'LIQUIDACAO' WHEN tipoOperacao = 'A' THEN 'AMORTIZACAO' END) AS tipoOperacao"))
                                ->where('dataLote', '=', $lote->getDataLoteAtual())
                                ->get();
            return json_encode($loteAnterior, JSON_UNESCAPED_SLASHES);
                break;
        }
    }

    public function contratosNaSumep()
    {
        $usuario = new Ldap;
        $empregado = Empregado::find($usuario->getMatricula());
        $empregadoAcesso = DB::table('tbl_EMPREGADOS')
                            ->join('tbl_ACESSA_EMPREGADOS', 'tbl_EMPREGADOS.matricula', '=', 'tbl_ACESSA_EMPREGADOS.matricula')
                            ->select('tbl_EMPREGADOS.*', 'tbl_ACESSA_EMPREGADOS.nivelAcesso')
                            ->where('tbl_ACESSA_EMPREGADOS.matricula', '=', $empregado->matricula)
                            ->get();
        
        switch ($empregadoAcesso[0]->nivelAcesso) {
            case 'EMPREGADO_AG':
                if ($empregadoAcesso[0]->codigoLotacaoFisica === null) {
                    $contratosSumep = DB::table('TBL_SIAF_DEMANDAS')
                                            ->select('codigoDemanda', 'nomeCliente', 'contratoCaixa', 'contratoBndes', 'valorOperacao', 'dataLote', 'status', 
                                                    DB::raw("(CASE WHEN tipoOperacao = 'L' THEN 'LIQUIDACAO' WHEN tipoOperacao = 'A' THEN 'AMORTIZACAO' END) AS tipoOperacao"))
                                            ->where('status', 'like', '%SUMEP%')
                                            ->where('codigoPa', '=', $empregadoAcesso[0]->codigoLotacaoAdministrativa)              
                                            ->get();      
                        return json_encode($contratosSumep, JSON_UNESCAPED_SLASHES);
                } else {
                    if (in_array($empregadoAcesso[0]->codigoLotacaoFisica, $this->arrayGigad)) {
                        $contratosSumep = DB::table('TBL_SIAF_DEMANDAS')
                                            ->select('codigoDemanda', 'nomeCliente', 'contratoCaixa', 'contratoBndes', 'valorOperacao', 'dataLote', 'status', 
                                                    DB::raw("(CASE WHEN tipoOperacao = 'L' THEN 'LIQUIDACAO' WHEN tipoOperacao = 'A' THEN 'AMORTIZACAO' END) AS tipoOperacao"))
                                            ->where('status', 'like', '%SUMEP%')
                                            ->where('codigoGigad', '=', $empregadoAcesso[0]->codigoLotacaoFisica)              
                                            ->get();;       
                        return json_encode($contratosSumep, JSON_UNESCAPED_SLASHES);
                    } elseif (in_array($empregadoAcesso[0]->codigoLotacaoFisica, $this->arraySR)) {
                        $contratosSumep = DB::table('TBL_SIAF_DEMANDAS')
                                            ->select('codigoDemanda', 'nomeCliente', 'contratoCaixa', 'contratoBndes', 'valorOperacao', 'dataLote', 'status', 
                                                    DB::raw("(CASE WHEN tipoOperacao = 'L' THEN 'LIQUIDACAO' WHEN tipoOperacao = 'A' THEN 'AMORTIZACAO' END) AS tipoOperacao"))
                                            ->where('status', 'like', '%SUMEP%')
                                            ->where('codigoSr', '=', $empregadoAcesso[0]->codigoLotacaoFisica)               
                                            ->get();;       
                        return json_encode($contratosSumep, JSON_UNESCAPED_SLASHES);
                    } else {
                        $contratosSumep = DB::table('TBL_SIAF_DEMANDAS')
                                            ->select('codigoDemanda', 'nomeCliente', 'contratoCaixa', 'contratoBndes', 'valorOperacao', 'dataLote', 'status', 
                                                    DB::raw("(CASE WHEN tipoOperacao = 'L' THEN 'LIQUIDACAO' WHEN tipoOperacao = 'A' THEN 'AMORTIZACAO' END) AS tipoOperacao"))
                                            ->where('status', 'like', '%SUMEP%')
                                            ->where('codigoPa', '=', $empregadoAcesso[0]->codigoLotacaoFisica)               
                                            ->get();;       
                        return json_encode($contratosSumep, JSON_UNESCAPED_SLASHES);
                    }                   
                }
                break;
            case 'EMPREGADO_SR':
                if ($empregadoAcesso[0]->codigoLotacaoFisica === null) {
                    $contratosSumep = DB::table('TBL_SIAF_DEMANDAS')
                                            ->select('codigoDemanda', 'nomeCliente', 'contratoCaixa', 'contratoBndes', 'valorOperacao', 'dataLote', 'status', 
                                                    DB::raw("(CASE WHEN tipoOperacao = 'L' THEN 'LIQUIDACAO' WHEN tipoOperacao = 'A' THEN 'AMORTIZACAO' END) AS tipoOperacao"))
                                            ->where('status', 'like', '%SUMEP%')
                                            ->where('codigoSr', '=', $empregadoAcesso[0]->codigoLotacaoAdministrativa)               
                                            ->get();;       
                    return json_encode($contratosSumep, JSON_UNESCAPED_SLASHES);
                } else {
                    if (in_array($empregadoAcesso[0]->codigoLotacaoFisica, $this->arrayGigad)) {
                        $contratosSumep = DB::table('TBL_SIAF_DEMANDAS')
                                            ->select('codigoDemanda', 'nomeCliente', 'contratoCaixa', 'contratoBndes', 'valorOperacao', 'dataLote', 'status', 
                                                    DB::raw("(CASE WHEN tipoOperacao = 'L' THEN 'LIQUIDACAO' WHEN tipoOperacao = 'A' THEN 'AMORTIZACAO' END) AS tipoOperacao"))
                                            ->where('status', 'like', '%SUMEP%')
                                            ->where('codigoGigad', '=', $empregadoAcesso[0]->codigoLotacaoFisica)                
                                            ->get();;       
                        return json_encode($contratosSumep, JSON_UNESCAPED_SLASHES);
                    } elseif (in_array($empregadoAcesso[0]->codigoLotacaoFisica, $this->arraySR)) {
                        $contratosSumep = DB::table('TBL_SIAF_DEMANDAS')
                                            ->select('codigoDemanda', 'nomeCliente', 'contratoCaixa', 'contratoBndes', 'valorOperacao', 'dataLote', 'status', 
                                                    DB::raw("(CASE WHEN tipoOperacao = 'L' THEN 'LIQUIDACAO' WHEN tipoOperacao = 'A' THEN 'AMORTIZACAO' END) AS tipoOperacao"))
                                            ->where('status', 'like', '%SUMEP%')
                                            ->where('codigoSr', '=', $empregadoAcesso[0]->codigoLotacaoFisica)                   
                                            ->get();;       
                        return json_encode($contratosSumep, JSON_UNESCAPED_SLASHES);
                    } else {
                        $contratosSumep = DB::table('TBL_SIAF_DEMANDAS')
                                            ->select('codigoDemanda', 'nomeCliente', 'contratoCaixa', 'contratoBndes', 'valorOperacao', 'dataLote', 'status', 
                                                    DB::raw("(CASE WHEN tipoOperacao = 'L' THEN 'LIQUIDACAO' WHEN tipoOperacao = 'A' THEN 'AMORTIZACAO' END) AS tipoOperacao"))
                                            ->where('status', 'like', '%SUMEP%')
                                            ->where('codigoPa', '=', $empregadoAcesso[0]->codigoLotacaoFisica)                      
                                            ->get();;       
                        return json_encode($contratosSumep, JSON_UNESCAPED_SLASHES);
                    }                   
                }
                break;
            case 'GIGAD':
                if ($empregadoAcesso[0]->codigoLotacaoFisica === null) {
                    $contratosSumep = DB::table('TBL_SIAF_DEMANDAS')
                                            ->select('codigoDemanda', 'nomeCliente', 'contratoCaixa', 'contratoBndes', 'valorOperacao', 'dataLote', 'status', 
                                                    DB::raw("(CASE WHEN tipoOperacao = 'L' THEN 'LIQUIDACAO' WHEN tipoOperacao = 'A' THEN 'AMORTIZACAO' END) AS tipoOperacao"))
                                            ->where('status', 'like', '%SUMEP%')
                                            ->where('codigoGigad', '=', $empregadoAcesso[0]->codigoLotacaoAdministrativa)                       
                                            ->get();;       
                    return json_encode($contratosSumep, JSON_UNESCAPED_SLASHES);
                } else {
                    if (in_array($empregadoAcesso[0]->codigoLotacaoFisica, $this->arrayGigad)) {
                        $contratosSumep = DB::table('TBL_SIAF_DEMANDAS')
                                            ->select('codigoDemanda', 'nomeCliente', 'contratoCaixa', 'contratoBndes', 'valorOperacao', 'dataLote', 'status', 
                                                    DB::raw("(CASE WHEN tipoOperacao = 'L' THEN 'LIQUIDACAO' WHEN tipoOperacao = 'A' THEN 'AMORTIZACAO' END) AS tipoOperacao"))
                                            ->where('status', 'like', '%SUMEP%')
                                            ->where('codigoGigad', '=', $empregadoAcesso[0]->codigoLotacaoFisica)                        
                                            ->get();;       
                        return json_encode($contratosSumep, JSON_UNESCAPED_SLASHES);
                    } elseif (in_array($empregadoAcesso[0]->codigoLotacaoFisica, $this->arraySR)) {
                        $contratosSumep = DB::table('TBL_SIAF_DEMANDAS')
                                            ->select('codigoDemanda', 'nomeCliente', 'contratoCaixa', 'contratoBndes', 'valorOperacao', 'dataLote', 'status', 
                                                    DB::raw("(CASE WHEN tipoOperacao = 'L' THEN 'LIQUIDACAO' WHEN tipoOperacao = 'A' THEN 'AMORTIZACAO' END) AS tipoOperacao"))
                                            ->where('status', 'like', '%SUMEP%')
                                            ->where('codigoSr', '=', $empregadoAcesso[0]->codigoLotacaoFisica)                          
                                            ->get();;       
                        return json_encode($contratosSumep, JSON_UNESCAPED_SLASHES); 
                    } else {      
                        $contratosSumep = DB::table('TBL_SIAF_DEMANDAS')
                                            ->select('codigoDemanda', 'nomeCliente', 'contratoCaixa', 'contratoBndes', 'valorOperacao', 'dataLote', 'status', 
                                                    DB::raw("(CASE WHEN tipoOperacao = 'L' THEN 'LIQUIDACAO' WHEN tipoOperacao = 'A' THEN 'AMORTIZACAO' END) AS tipoOperacao"))
                                            ->where('status', 'like', '%SUMEP%')
                                            ->where('codigoPa', '=', $empregadoAcesso[0]->codigoLotacaoFisica)
                                            ->get();;       
                        return json_encode($contratosSumep, JSON_UNESCAPED_SLASHES);  
                    }                   
                }
                break;
            default:
            $contratosSumep = DB::table('TBL_SIAF_DEMANDAS')
                                ->select('codigoDemanda', 'nomeCliente', 'contratoCaixa', 'contratoBndes', 'valorOperacao', 'dataLote', 'status', 
                                        DB::raw("(CASE WHEN tipoOperacao = 'L' THEN 'LIQUIDACAO' WHEN tipoOperacao = 'A' THEN 'AMORTIZACAO' END) AS tipoOperacao"))
                                ->where('status', 'like', '%SUMEP%')
                                ->get();
            return json_encode($contratosSumep, JSON_UNESCAPED_SLASHES);
                break;
        }
    }

    public function showDemandaComHistoricos($demanda)
    {
        $loteDemanda = SiafDemanda::find($demanda);
        $dataLote = $loteDemanda->dataLote;
        $dadosDemanda = SiafDemanda::with(
            ['SiafHistoricoDemanda' => function($respostaHistorico) use($dataLote) {
                json_encode($respostaHistorico->where('loteAmortizacao', $dataLote), JSON_UNESCAPED_SLASHES);
            }, 'SiafHistoricoSaldoContaAmortizacao' => function($respostaSaldo) use($dataLote) { 
                $respostaSaldo->where('loteAmortizacao', $dataLote);
            }])->where('TBL_SIAF_DEMANDAS.codigoDemanda', $demanda)->get();
        $arrayHistorico = [];
        $arraySaldo = [];
        if(isset($dadosDemanda[0]->SiafHistoricoSaldoContaAmortizacao)) {
            foreach ($dadosDemanda[0]->SiafHistoricoSaldoContaAmortizacao as $saldo => $value) {             
                $dadosSaldo = array(
                    "codigoConsultaSaldo" => $value['codigoHistorico'], 
                    "dataConsultaSaldo" => $value['created_at']->format('d/m/Y H:i:s'),
                    "statusSaldo" => $value['tipoHistorico'],
                    "saldoDisponivel" => number_format($value['saldoDisponivel'], 2, ',', '.'),
                    "saldoBloqueado" => number_format($value['saldoBloqueado'], 2, ',', '.'),
                    "LimiteChequeAzul" => number_format($value['limiteChequeAzul'], 2, ',', '.'),
                    "LimiteGim" => number_format($value['limiteGim'], 2, ',', '.'),
                    "saldoTotal" => number_format($value['saldoTotal'], 2, ',', '.'),
                );
                array_push($arraySaldo, $dadosSaldo);
            }
        } else {
            $dadosSaldo = array(
                "codigoConsultaSaldo" => null, 
                "dataConsultaSaldo" => null,
                "statusSaldo" => null,
                "saldoDisponivel" => null,
                "saldoBloqueado" => null,
                "LimiteChequeAzul" => null,
                "LimiteGim" => null,
                "saldoTotal" => null,
            );
        }
        if(isset($dadosDemanda[0]->SiafHistoricoDemanda)) {
            foreach ($dadosDemanda[0]->SiafHistoricoDemanda as $historico => $value) {               
                $dadosHistorico = array(
                    "codigoHistorico" => $value['codigoHistorico'], 
                    "dataHistorico" => $value['created_at']->format('d/m/Y H:i:s'),
                    "statusHistorico" => $value['tipoHistorico'],
                    "matriculaResponsavel" => $value['matriculaResponsavel'],
                    "unidadeResponsavel" => str_pad($value['unidadeResponsavel'], 4, '0', STR_PAD_LEFT),
                    "observacaoHistorico" => utf8_decode($value['historico'])
                );
                array_push($arrayHistorico, $dadosHistorico);
            }
        } else {
            $dadosHistorico = array(
                "codigoHistorico" => null, 
                "dataHistorico" => null,
                "statusHistorico" => null,
                "matriculaResponsavel" => null,
                "unidadeResponsavel" => null,
                "observacaoHistorico" => null
            );
        }
        switch($dadosDemanda[0]->tipoOperacao){
            case 'L':
                $tipoOperacao = "LIQUIDACAO";
                break;
            case 'A':
                $tipoOperacao = "AMORTIZACAO";
                break;
        }
        $jsonDados = [
            "codigoDemanda" => $dadosDemanda[0]->codigoDemanda,
            "nomeCliente" => $dadosDemanda[0]->nomeCliente,
            "cnpj" => $dadosDemanda[0]->cnpj, 
            "codigoDemanda" => $dadosDemanda[0]->codigoDemanda,
            "contratoBndes" => $dadosDemanda[0]->contratoBndes,
            "contratoCaixa" => $dadosDemanda[0]->contratoCaixa,
            "contaDebito" => $dadosDemanda[0]->contaDebito,
            "dataLote"=> $dadosDemanda[0]->dataLote,
            "valorOperacao" => number_format($dadosDemanda[0]->valorOperacao, 2, ',', '.'),
            "tipoOperacao" => $tipoOperacao,
            "status" => $dadosDemanda[0]->status,
            "codigoPa" => str_pad($dadosDemanda[0]->codigoPa, 4, '0', STR_PAD_LEFT),
            "codigoSr" => $dadosDemanda[0]->codigoSr,
            "codigoGigad" => $dadosDemanda[0]->codigoGigad,
            "consultaSaldo" => $arraySaldo,
            "historicoContrato" => $arrayHistorico
        ];
        if (isset($jsonDados)) {
            return json_encode($jsonDados, JSON_UNESCAPED_SLASHES);
        } else{
            return response('Demanda não encontrada', 404);
        }
    }
}