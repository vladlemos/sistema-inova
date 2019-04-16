<?php

namespace App\Http\Controllers\Sistemas;

use App\Empregado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Classes\Geral\Ldap;
use App\AcessaEmpregado;

class AcessaEmpregadoController extends Controller
{
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
     * @param  \App\AcessaEmpregado  $acessaEmpregado
     * @return \Illuminate\Http\Response
     */
    public function show(AcessaEmpregado $acessaEmpregado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AcessaEmpregado  $acessaEmpregado
     * @return \Illuminate\Http\Response
     */
    public function edit(AcessaEmpregado $acessaEmpregado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AcessaEmpregado  $acessaEmpregado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AcessaEmpregado $acessaEmpregado)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AcessaEmpregado  $acessaEmpregado
     * @return \Illuminate\Http\Response
     */
    public function destroy(AcessaEmpregado $acessaEmpregado)
    {
        //
    }
}
