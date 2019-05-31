<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// use Illuminate\Support\Facades\DB;
use App\Models\Bndes\NovoSiaf\AtendimentoWebListaAtividades;

/* ROTAS GERAIS CEOPC */
Route::get('/', function () {return 'Hello World';});
Route::get('/phpinfo', function () {return view('phpinfo');});
Route::get('/consumo-json-multinivel', function () {return view('consumoJsonMultinivel');});
Route::fallback(function(){return response()->view('errors.404', [], 404);});

/* ROTAS ESTEIRA COMEX */
Route::prefix('esteiracomex')->group(function(){
    
    // HOME
    Route::get('/', function () {
        return view('Comex.Home.index');
    });
    
    

    /* ESTEIRA CONTRATACAO */
    Route::get('contratacao', function () {
        return view('Comex.Contratacao.index');
    });
    
    // Indicadores Antecipados
    Route::get('indicadores/antecipados', function () {
        return view('Comex.Indicadores.antecipados');
    });

    // Distribuir demandas
    Route::get('distribuir', function () {
        return view('Comex.Distribuir.index');
    });

    // ACOMPANHAMENTOS
    Route::get('distribuir/demandas', function () {
        return view('Comex.Distribuir.demandas');
    });

});

/* ROTAS BNDES SIAF */
    Route::prefix('bndes')->group(function(){
    /* NOVOSIAF */
    
        Route::get('siaf-amortizacao-liquidacao', function () {
            return view('Bndes.NovoSiaf.index');
        });
        Route::get('siaf-amortizacao-liquidacao/teste-de-email', function () {
            return view('Bndes.NovoSiaf.envio-de-email');
        });
    });


