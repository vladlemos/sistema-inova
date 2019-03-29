<?php

use Illuminate\Http\Request;
use App\Models\NovoSiaf\TabelaSiafAmortizacoes;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::fallback(function(){
//     return response()->json(['message' => 'Not Found!'], 404);
// });


Route::get('/siaf_amortizacoes_lote_anterior', 'TabelaSiafAmortizacoesController@loteAnterior');
Route::get('/siaf_amortizacoes_lote_atual', 'TabelaSiafAmortizacoesController@loteAtual');
Route::get('/siaf_contratos_sumep', 'TabelaSiafAmortizacoesController@contratosNaSumep');
Route::get('/dados_empregado', 'TabelaSiafAmortizacoesController@acessoEmpregado');
Route::get('/siaf_api_completa', 'TabelaSiafAmortizacoesController@apiCompleta');
Route::get('/siaf_contratos_a_liquidar', 'TabelaSiafAmortizacoesController@contratosParaLiquidar');

// Route::get('/siaf_contratos_a_liquidar/{contrato}', 'TabelaSiafAmortizacoesController@showDadosContrato');

Route::resource('bndes/v1/siaf_contratos', 'ContratosController');