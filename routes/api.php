<?php

use Illuminate\Http\Request;
use App\Models\Bndes\NovoSiaf\TabelaSiafAmortizacoes;

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


Route::get('/siaf_amortizacoes_lote_anterior', 'Bndes\NovoSiaf\TabelaSiafAmortizacoesController@loteAnterior');
Route::get('/siaf_amortizacoes_lote_atual', 'Bndes\NovoSiaf\TabelaSiafAmortizacoesController@loteAtual');
Route::get('/siaf_contratos_sumep', 'Bndes\NovoSiaf\TabelaSiafAmortizacoesController@contratosNaSumep');
Route::get('/dados_empregado', 'Bndes\NovoSiaf\TabelaSiafAmortizacoesController@acessoEmpregado');
Route::get('/siaf_api_completa', 'Bndes\NovoSiaf\TabelaSiafAmortizacoesController@apiCompleta');
Route::get('/siaf_contratos_a_liquidar', 'Bndes\NovoSiaf\TabelaSiafAmortizacoesController@contratosParaLiquidar');

// Route::get('/siaf_contratos_a_liquidar/{contrato}', 'TabelaSiafAmortizacoesController@showDadosContrato');

Route::resource('bndes/v1/siaf_contratos', 'Bndes\NovoSiaf\ContratosController');
