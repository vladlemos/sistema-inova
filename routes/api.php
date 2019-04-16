<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::get('/siaf_amortizacoes_lote_anterior', 'Bndes\NovoSiaf\TabelaSiafAmortizacoesController@loteAnterior');
// Route::get('/siaf_amortizacoes_lote_atual', 'Bndes\NovoSiaf\TabelaSiafAmortizacoesController@loteAtual');
// Route::get('/siaf_contratos_sumep', 'Bndes\NovoSiaf\TabelaSiafAmortizacoesController@contratosNaSumep');
// Route::get('/dados_empregado', 'Bndes\NovoSiaf\DadosLoteEmpregadosSiafController@acessoEmpregado');

/* ROTAS UTILIZADAS EM TODOS OS SISTEMAS CEOPC */
    Route::get('sistemas/v1/dados_empregado', 'Sistemas\EmpregadoController@dadosEmpregado');


/* ROTAS UTILIZADAS EM PROJETOS ESPECIFICOS */

/* ROTAS BNDES */

    /* NOVOSIAF */
        Route::resource('bndes/v1/siaf_contratos', 'Bndes\NovoSiaf\ContratosController');
        Route::get('bndes/v1/siaf_amortizacoes_lote_atual', 'Bndes\NovoSiaf\TabelaSiafAmortizacoesController@loteAtual');
        Route::get('bndes/v1/siaf_amortizacoes_lote_anterior', 'Bndes\NovoSiaf\TabelaSiafAmortizacoesController@loteAnterior');
        Route::get('bndes/v1/siaf_contratos_sumep', 'Bndes\NovoSiaf\TabelaSiafAmortizacoesController@contratosNaSumep');
        Route::get('bndes/v1/siaf_amortizacoes/{demanda}', 'Bndes\NovoSiaf\TabelaSiafAmortizacoesController@show');


