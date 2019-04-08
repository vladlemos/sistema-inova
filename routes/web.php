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

Route::get('/', function () {return 'Hello World';});

Route::prefix('bndes')->group(function(){
    Route::get('siaf-amortizacao-liquidacao', function () 
    {
        return view('Bndes.NovoSiaf.index');
    });
});

Route::fallback(function(){
    return response()->view('errors.404', [], 404);
});
