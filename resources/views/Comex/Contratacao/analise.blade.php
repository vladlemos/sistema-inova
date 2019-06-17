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

    <form method="POST" action="../../js/contratacao/backend/post_teste_inova.php" enctype="multipart/form-data" class="form-horizontal" id="formAnaliseDemanda">

        <div class="form-group">

            <label class="col-sm-1 control-label">CNPJ:</label>
            <div class="col-sm-2">
                <p class="form-control mascaracnpj" name="cnpj" id="cpfCnpj">10222222000188</p>
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

        </div>  <!--/form-group-->


        <div class="form-group">

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
    
        </div>  <!--/form-group-->

        <div class="form-group">

            <label class="col-sm-1 control-label">Dados do Beneficiário:</label>
            <div class="col-sm-3">
                <p class="form-control" name="dadosContaBeneficiario1" id="dadosContaBeneficiario1">Nome do Beneficiário</p>
            </div>
            <div class="col-sm-3">
                <p class="form-control" name="dadosContaBeneficiario2" id="dadosContaBeneficiario2">Banco Beneficiário</p>
            </div>
            <div class="col-sm-3">
                <p class="form-control" name="dadosContaBeneficiario3" id="dadosContaBeneficiario3">IBAN IBAN IBAN 00000</p>
            </div>
            <div class="col-sm-2">
                <p class="form-control" name="dadosContaBeneficiario4" id="dadosContaBeneficiario4">Conta</p>
            </div>
        </div>  <!--/form-row-->

    <hr>

        <div class="form-group">

            <label class="col-sm-1 control-label">Data de Liquidação:</label>
            <div class="col-sm-2">
                <input class="form-control" name="dataLiquidacao" id="dataLiquidacao" type="date" placeholder="DD/MM/AAAA" required>
            </div>

            <label class="col-sm-1 control-label">Número do Boleto:</label>
            <div class="col-sm-2">
                <input class="form-control" name="numeroBoleto" id="numeroBoleto" type="number" required>
            </div>

            <label class="col-sm-1 control-label">Status:</label>
            <div class="col-sm-3">
                    <select class="form-control" name="statusGeral" id="statusGeral" required>
                        <option value="">Selecione</option>
                        <option value="Inconforme">Inconforme</option>
                        <option value="Conforme">Conforme</option>
                        <option value="Conta OK">Conta OK</option>
                        <option value="Conferido">Conferido</option>
                        <option value="Cancelar">Cancelar</option>
                    </select>
            </div>

        </div>  <!--/form-group-->

    <hr>

        <div class="page-bar">
            <h3>Check-list</h3>
        </div>

        <div class="row">

        <div class="col-md-6">

            <div class="form-group">
                <label class="col-sm-3 control-label">Invoice:</label>
                <div class="col-sm-3">
                        <select class="form-control" name="statusInvoice" id="statusInvoice" required>
                            <option value="">Selecione</option>
                            <option value="Conforme">Conforme</option>
                            <option value="Inconforme">Inconforme</option>
                            <option value="N/A">N/A</option>
                        </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Conhecimento:</label>
                <div class="col-sm-3">
                        <select class="form-control" name="statusConhecimento" id="statusConhecimento" required>
                            <option value="">Selecione</option>
                            <option value="Conforme">Conforme</option>
                            <option value="Inconforme">Inconforme</option>
                            <option value="N/A">N/A</option>
                        </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">DI / DU-E:</label>
                <div class="col-sm-3">
                        <select class="form-control" name="statusDiDue" id="statusDiDue" required>
                            <option value="">Selecione</option>
                            <option value="Conforme">Conforme</option>
                            <option value="Inconforme">Inconforme</option>
                            <option value="N/A">N/A</option>
                        </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Dados Bancários:</label>
                <div class="col-sm-3">
                        <select class="form-control" name="statusDadosBancarios" id="statusDadosBancarios" required>
                            <option value="">Selecione</option>
                            <option value="Conforme">Conforme</option>
                            <option value="Inconforme">Inconforme</option>
                            <option value="N/A">N/A</option>
                        </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Autorização SR:</label>
                <div class="col-sm-3">
                        <select class="form-control" name="statusAutorizacaoSr" id="statusAutorizacaoSr" required>
                            <option value="">Selecione</option>
                            <option value="Conforme">Conforme</option>
                            <option value="Inconforme">Inconforme</option>
                            <option value="N/A">N/A</option>
                        </select>
                </div>
            </div>

        </div>  <!--/col-md-6-->

        <div class="col-md-6">
            <div class="form-group">
                <label class="col-sm-2 control-label">Observações:</label>
                <div class="col-sm-10">
                    <textarea class="form-control" rows="10" name="observacoesCeopc" id="observacoesCeopc"></textarea>
                </div>
            </div>
        </div>  <!--/col-md-6-->

        </div> <!--/row-->

    <hr>

        <div class="page-bar">
            <h3>Histórico</h3>
        </div>


        <div class="form-group">
            <div class="col-sm-12">
                <p class="form-control" id="historico">c142765 - Status: Inconforme - 14/06 - Observação: Campo X do documento Y inconforme.</p>
            </div>
        </div>
    <hr>

        <div class="page-bar">
            <h3>Documentação digitalizada</h3>
        </div>
<br>

    <div id="divModais">

        <!-- <div id="divModalInvoice1">

            <a rel="tooltip" class="btn btn-primary btn-lg" title="Visualizar arquivo." data-toggle="modal" data-target="#modalInvoice1">
                <span class="glyphicon glyphicon-file">    Invoice 1</span>
            </a> 

            <div class="modal fade" id="modalInvoice1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">Invoice 1</h4>
                        </div>
                        <div class="modal-body">
                            <a href="#!" class="modal-close waves-effect waves-green btn-flat" id="btn_fecha_modal"></a>
                            <embed src="../../js/contratacao/upload-teste/10222222000188/546654/invoice_546654.jpg" width="100%" height="100%" />
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>

<br>

        <div id="divModalDi1">

            <a rel="tooltip" class="btn btn-primary btn-lg" title="Visualizar arquivo." data-toggle="modal" data-target="#modalDi1">
            <span class="glyphicon glyphicon-file">    DI 1</span>
            </a> 

            
            <div class="modal fade" id="modalDi1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">DI 1</h4>
                        </div>
                        <div class="modal-body">
                            <a href="#!" class="modal-close waves-effect waves-green btn-flat" id="btn_fecha_modal"></a>
                            <embed src="../../js/contratacao/upload-teste/10222222000188/546654/di_546654.pdf" width="100%" height="600px" />
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>  -->

    </div>

<hr>

        <div class="form-group row">
            <div class="col-sm-1">
            <button type="submit" id="submitBtn" class="btn btn-primary">Gravar</button>
            </div>
        </div>

    </form>

</div>  <!--panel-body-->

</div>  <!--panel panel-default-->

</div>  <!--container-fluid-->



@stop



@section('css')
    <!-- <link href="{{ asset('js/plugins/kartik-v-bootstrap-fileinput-226d7e0/css/fileinput.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('js/plugins/kartik-v-bootstrap-fileinput-226d7e0/themes/explorer/theme.css') }}" rel="stylesheet"/> -->
    <link href="{{ asset('css/contratacao/cadastro.css') }}" rel="stylesheet">
     


@stop

@section('js')
    <!-- <script src="{{ asset('js/plugins/jquery/jquery-1.12.1.min.js') }}"></script> -->
    <!-- <script src="{{ asset('js/contratacao/jquery-3.4.1.min.js') }}"></script> -->
    <script src="{{ asset('js/plugins/jquery/jquery-ui.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="{{ asset('js/plugins/numeral/numeral.min.js') }}"></script>


    <!-- <script src="{{ asset('js/plugins/kartik-v-bootstrap-fileinput-226d7e0/js/plugins/piexif.min.js') }}"></script>
    <script src="{{ asset('js/plugins/kartik-v-bootstrap-fileinput-226d7e0/js/plugins/sortable.min.js') }}"></script>
    <script src="{{ asset('js/plugins/kartik-v-bootstrap-fileinput-226d7e0/js/fileinput.min.js') }}"></script>
    <script src="{{ asset('js/plugins/kartik-v-bootstrap-fileinput-226d7e0/js/locales/pt-BR.js') }}"></script>
    <script src="{{ asset('js/plugins/kartik-v-bootstrap-fileinput-226d7e0/themes/fa/theme.js') }}"></script>
    <script src="{{ asset('js/plugins/kartik-v-bootstrap-fileinput-226d7e0/themes/fas/theme.js') }}"></script>
    <script src="{{ asset('js/plugins/kartik-v-bootstrap-fileinput-226d7e0/themes/explorer/theme.js') }}"></script> -->
    <script src="{{ asset('js/contratacao/post_analise_demanda3.js') }}"></script>





@stop