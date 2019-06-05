@extends('adminlte::page')

@section('title', 'EsteiraComex - Análise Contratação')

@section('content_header')
    
    <h4 class="animated bounceInLeft">
        Esteira de Contratação | 
        <small>Contratação - Análise de demandas </small>
    </h4>
    
<!-- arrumar -->

    <ol class="breadcrumb"> 
            <li><a href="#"><i class="fa fa-dashboard"></i>Solicitar Atendimento </a></li>
            <li><a href="#"></i>Contratação</a></li>
    </ol>

@stop

@section('content')


                <!-- ########################################## CONTEÚDO ÚNICO ################################################ -->



<div class="container-fluid">

<div class="panel panel-default">

<div class="panel-body">


    <div class="page-bar">
        <h3>Contratação - Análise de Demanda - Protocolo #  <p class="inline" name="id_demanda" id="idDemanda">546654</p></h3>
    </div>

<br>

    <form method="POST" action="" enctype="multipart/form-data" id="formAnaliseDemanda">

        <div class="form-group row">
            <label class="col-sm-1 control-label">CNPJ:</label>
            <div class="col-sm-2">
                <p class="form-control mascaracnpj" name="cnpj" id="cnpj">10222222000188</p>
            </div>

            <label class="col-sm-1 control-label">Nome:</label>
            <div class="col-sm-4">
                <p class="form-control" name="nomeCliente" id="nomeCliente">empresa empresa empresa ltda</p>
            </div>
    
            <label class="col-sm-1 control-label">Agência:</label>
            <div class="col-sm-1">
                <p class="form-control" name="agResponsavel" id="agResponsavel">2728</p>
            </div>

            <label class="col-sm-1 control-label">SR:</label>
            <div class="col-sm-1">
                <p class="form-control" name="srResponsavel" id="srResponsavel">4040</p>
            </div>

        </div>  <!--/form-group row-->


        <div class="form-group row">

                <label class="col-sm-1 control-label">Operação:</label>
                <div class="col-sm-2">
                    <p class="form-control" name="tipoOperacao" id="tipoOperacao">Pronto Importação</p>
                </div>

                <label class="col-sm-1 control-label">Moeda:</label>
                <div class="col-sm-1">
                    <p class="form-control" name="tipoMoeda" id="tipoMoeda">USD</p>
                </div>

                <label class="col-sm-1 control-label">Valor:</label>
                <div class="col-sm-2">
                    <p class="form-control" name="valorOperacao" id="valorOperacao">66.666,66</p>
                </div>
        
                <label class="col-sm-1 control-label">Data de Embarque:</label>
                <div class="col-sm-2">
                    <p class="form-control" name="dataPrevistaEmbarque" id="dataPrevistaEmbarque">12/12/1212</p>
                </div>
        
        </div>  <!--/form-row-->

        <div class="form-row">

            <div class="form-row margin10">
                <label class="control-label">Dados do Beneficiário:</label>
            </div>  <!--/form-group row col-->
            
                <p class="form-control col" name="dadosContaBeneficiario1" id="dadosContaBeneficiario1">Nome do Beneficiário</p>
                <p class="form-control col" name="dadosContaBeneficiario2" id="dadosContaBeneficiario2">Banco Beneficiário</p>
                <p class="form-control col" name="dadosContaBeneficiario3" id="dadosContaBeneficiario3">IBAN IBAN IBAN IBAN 00000</p>

        </div>  <!--/form-row-->



    <hr>


        <div class="form-row">

            <div class="form-row margin10">
                <label class="control-label">Data de Liquidação:</label>
                <input name="dataLiquidacao" type="date" placeholder="DD/MM/AAAA">
            </div>

            <div class="form-row margin10">
                <label class="control-label">Número do Boleto:</label>
                <input name="numeroBoleto" type="number">
            </div>

            <div class="form-row margin10">
                <label class="control-label">Status:</label>
                <div>
                    <select name="status" class="form-control" id="status">
                        <option value="1">Inconforme</option>
                        <option value="2">Conforme</option>
                        <option value="3">Conta OK</option>
                        <option value="4">Conferido</option>
                        <option value="5">Cancelar</option>
                    </select>
                </div>
            </div>

        </div>  <!--/form-row-->

    <br>

    <hr>

    <label class="control-label margin10">Checklist:</label>

    <div class="form-row">

        <div class="form-group margin10">
            <label class="control-label margin10">Invoice:</label> 
    <br>
            <label class="control-label margin10">Conhecimento de Embarque:</label>
    <br>
            <label class="control-label margin10">DI / DU-E:</label>
    <br>
            <label class="control-label margin10">Dados Bancários:</label>
    <br>
            <label class="control-label margin10">Autorização SR:</label>
        </div>

        <div class="form-group margin10">

            <div class="form-check form-check-inline padding7">
                <input class="form-check-input" type="radio" name="analiseInvoice" value="conforme">
                <label class="form-check-label">Conforme</label>
            </div>
            <div class="form-check form-check-inline padding7">
                <input class="form-check-input" type="radio" name="analiseInvoice" value="inconforme">
                <label class="form-check-label">Inconforme</label>
            </div>
            <div class="form-check form-check-inline padding7">
                <input class="form-check-input" type="radio" name="analiseInvoice" value="naoSeAplica">
                <label class="form-check-label">N/A</label>
            </div>
    <br>
            <div class="form-check form-check-inline padding7">
                <input class="form-check-input" type="radio" name="analiseEmbarque" value="conforme">
                <label class="form-check-label">Conforme</label>
            </div>
            <div class="form-check form-check-inline padding7">
                <input class="form-check-input" type="radio" name="analiseEmbarque" value="inconforme">
                <label class="form-check-label">Inconforme</label>
            </div>
            <div class="form-check form-check-inline padding7">
                <input class="form-check-input" type="radio" name="analiseEmbarque" value="naoSeAplica">
                <label class="form-check-label">N/A</label>
            </div>
    <br>
            <div class="form-check form-check-inline padding7">
                <input class="form-check-input" type="radio" name="analiseDeclaracao" value="conforme">
                <label class="form-check-label">Conforme</label>
            </div>
            <div class="form-check form-check-inline padding7">
                <input class="form-check-input" type="radio" name="analiseDeclaracao" value="inconforme">
                <label class="form-check-label">Inconforme</label>
            </div>
            <div class="form-check form-check-inline padding7">
                <input class="form-check-input" type="radio" name="analiseDeclaracao" value="naoSeAplica">
                <label class="form-check-label">N/A</label>
            </div>
    <br>
            <div class="form-check form-check-inline padding7">
                <input class="form-check-input" type="radio" name="analiseDadosBancarios" value="conforme">
                <label class="form-check-label">Conforme</label>
            </div>
            <div class="form-check form-check-inline padding7">
                <input class="form-check-input" type="radio" name="analiseDadosBancarios" value="inconforme">
                <label class="form-check-label">Inconforme</label>
            </div>
            <div class="form-check form-check-inline padding7">
                <input class="form-check-input" type="radio" name="analiseDadosBancarios" value="naoSeAplica">
                <label class="form-check-label">N/A</label>
            </div>
    <br>
            <div class="form-check form-check-inline padding7">
                <input class="form-check-input" type="radio" name="analiseAutorizaSr" value="conforme">
                <label class="form-check-label">Conforme</label>
            </div>
            <div class="form-check form-check-inline padding7">
                <input class="form-check-input" type="radio" name="analiseAutorizaSr" value="inconforme">
                <label class="form-check-label">Inconforme</label>
            </div>
            <div class="form-check form-check-inline padding7">
                <input class="form-check-input" type="radio" name="analiseAutorizaSr" value="naoSeAplica">
                <label class="form-check-label">N/A</label>
            </div>

        </div>

    </div>  <!--/form-row-->

<br>

    <div class="form-row">

        <div class="form-row margin10">
            <label class="control-label">Observações:</label>
            <div class="">
            <textarea class="form-control" rows="5" cols="120" name="analiseCeopc" id="observacoes"></textarea>
            </div>
        </div>

    </div>  <!--/form-row-->

    <hr>

    <div class="margin10">

        <div class="file-loading">
            <input id="input-iconic" name="analise" type="file" multiple>
        </div>
            
    </div><!--/margin10-->

<br>

        <div class="form-group row">
            <div class="col-sm-2">
            <button type="submit" id="submitBtn" class="btn btn-secondary">Gravar</button>
            </div>
        </div>

    </form>

</div>  <!--panel-body-->

</div>  <!--panel panel-default-->

</div>  <!--container-fluid-->



@stop



@section('css')
    <link href="{{ asset('css/contratacao/cadastro.css') }}" rel="stylesheet">
    <link href="{{ asset('js/plugins/kartik-v-bootstrap-fileinput-226d7e0/css/fileinput.css') }}" rel="stylesheet"/>
    <link href="{{ asset('js/plugins/kartik-v-bootstrap-fileinput-226d7e0/themes/explorer/theme.css') }}" rel="stylesheet"/>
     


@stop

@section('js')
    <script src="{{ asset('js/plugins/jquery/jquery-1.12.1.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/plugins/numeral/numeral.min.js') }}"></script>


    <script src="{{ asset('js/plugins/kartik-v-bootstrap-fileinput-226d7e0/js/plugins/piexif.min.js') }}"></script>
    <script src="{{ asset('js/plugins/kartik-v-bootstrap-fileinput-226d7e0/js/plugins/sortable.min.js') }}"></script>
    <script src="{{ asset('js/plugins/kartik-v-bootstrap-fileinput-226d7e0/js/fileinput.min.js') }}"></script>
    <script src="{{ asset('js/plugins/kartik-v-bootstrap-fileinput-226d7e0/js/locales/pt-BR.js') }}"></script>
    <script src="{{ asset('js/plugins/kartik-v-bootstrap-fileinput-226d7e0/themes/fa/theme.js') }}"></script>
    <script src="{{ asset('js/plugins/kartik-v-bootstrap-fileinput-226d7e0/themes/fas/theme.js') }}"></script>
    <script src="{{ asset('js/plugins/kartik-v-bootstrap-fileinput-226d7e0/themes/explorer/theme.js') }}"></script>


    <script src="{{ asset('js/plugins/masks/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('js/contratacao/funcoes_cadastro.js') }}"></script>
    <script src="{{ asset('js/contratacao/post_cadastro.js') }}"></script>


    <!-- <script src="carrega_json_matricula_hidden.js"></script> -->
    <!-- <script src="assets/js/shared/site.js"></script> -->





@stop