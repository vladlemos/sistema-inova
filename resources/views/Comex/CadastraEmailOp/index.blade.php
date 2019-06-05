@extends('adminlte::page')

@section('title', 'Esteira Comex - Cadastro Email Op')


@section('content_header')
    
    <h4 class="animated bounceInLeft">
        Gerenciador de email externos | 
        <small>Lista de emails externos cadastrados na esteira</small>
    </h4>
    
    <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Acompanhamentos</a></li>
            <li><a href="#"></i>Minhas Demandas</a></li>
    </ol>

@stop


@section('content')

<div class ="panel panel-default">
    <div class="panel-body">
    
        <div>
            <h2>Atualização de e-mails Corporativo</h2>
            <p>O propósito desta página é o de agilizar a comunicação entre a CAIXA e o cliente corporativo (COMEX).</p>
        </div>
        <div class="alert bg-warning" role="alert" id>
            <p class="text-danger">## ATENÇÃO ##</p>
            <p>Declaro estar ciente de que a inclusão ou alteração do e-mail precede a expressa manifestação do cliente para recepção de avisos de ordens de pagamento recebidas pela CAIXA através deste canal de comunicação. 
            A não observância deste procedimento pode ocasionar em risco de imagem para CAIXA e apuração de responsabilidade nos moldes do AE079.</p>
        </div>
        <div class="table-responsive">
            <table id="tabelaEmail"class="table table-striped display">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>CNPJ</th>
                        <th>Email Principal</th>
                        <th>Agência</th>
                        <th>Ação</th>
                    </tr>
                </thead>

                <tbody> </tbody>

            </table>
        </div>
    
    </div>
</div>

@stop


@section('css')
   
    <link href="{{ asset('css/comex/index.css') }}" rel="stylesheet" type="text/css"> 
   
@stop


@section('js')

    <script src="{{ asset('js/Comex/index.js')}}"></script>

@stop