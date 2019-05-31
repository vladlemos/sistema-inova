
@extends('adminlte::page')

@section('title', 'EsteiraComex - Solicitar Contratação')

@section('content_header')
    
    <h4 class="animated bounceInLeft">
        Esteira de Contratação | 
        <small>Contratação - Cadastro de demandas </small>
    </h4>
    
    <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Solicitar Atendimento </a></li>
            <li><a href="#"></i>Contratação</a></li>
    </ol>

@stop

@section('content')


<div class="panel panel-default">

<div class="container conteudo-wrapper ml-3">

    <div class="page-bar">
        <h1>Contratação - Cadastro de Demanda</h1>
    </div>
<br>
    <form method="POST" action="/esteira-contratacao/backend/post_teste.php" enctype="multipart/form-data" id="formTipoOperacao">

        <fieldset class="form-group">
            <div class="row">
           
            <label class="col-sm-2 col-form-label">Tipo de Cliente:</label>
            <div class="col-sm-10">
                <div class="form-check form-check-inline">
                <input class="form-check-input" name="escolheTipoPessoa" value="2" type="radio">
                <label class="form-check-label" for="gridRadios1">PF</label>
                </div>
                <div class="form-check form-check-inline">
                <input class="form-check-input" name="escolheTipoPessoa" value="3" checked="checked" type="radio">
                <label class="form-check-label" for="gridRadios2">PJ</label>
                </div>
            </div>  <!--/col-->
            </div>  <!--/row-->
        </fieldset>

        <div id="cpfCnpj2" class="form-group row desc" style="">
            <label class="col-sm-2 col-form-label">CPF:</label>
            <div>
            <input class="form-control mascaracpf" name="cpf" id="cpf" placeholder="CPF" maxlength="14" type="text">
            </div>
        </div>  <!--/cpfCnpj2-->

        <div id="cpfCnpj3" class="form-group row desc" style="display: none;">
            <label class="col-sm-2 col-form-label">CNPJ:</label>
            <div>
            <input class="form-control mascaracnpj" name="cnpj" id="cnpj" placeholder="CNPJ" maxlength="18" type="text">
            </div>
        </div>  <!--/cpfCnpj3-->

        <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label">Nome:</label>
            <div class="col-sm-6">
            <input class="form-control" name="nomeCliente" id="nomeCliente" placeholder="Nome" type="text">
            </div>
        </div>  <!--/form-group row-->

    <hr>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Tipo de Operação:</label>
            <div>
                <select class="form-control" id="tipoOperacao" placeholder="Selecione uma modalidade">
                    <option value="1">Nenhum</option>
                    <option value="2">Pronto Importação Antecipado</option>
                    <option value="3">Pronto Importação</option>
                    <option value="4">Pronto Exportação Antecipado</option>
                    <option value="5">Pronto Exportação</option>
                </select>
            </div>
        </div>  <!--/form-group row-->

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Tipo de Moeda:</label>
            <div>
                <select class="form-control" id="tipoMoeda" placeholder="Selecione uma moeda">
                    <option value="DKK">Coroa Dinamarquesa - DKK</option>
                    <option value="NOK">Coroa Norueguesa - NOK</option>
                    <option value="SEK">Coroa Sueca - SEK</option>
                    <option value="USD" selected="selected">Dólar Americano - USD</option>
                    <option value="AUD">Dólar Australiano - AUD</option>
                    <option value="CAD">Dólar Canadense - CAD</option>
                    <option value="NZD">Dólar Neozelandês - NZD</option>
                    <option value="EUR">Euro - EUR</option>
                    <option value="CHF">Franco Suíço - CHF</option>
                    <option value="JPY">Iene - JPY</option>
                    <option value="GBP">Libra Esterlina - GBP</option>
                    <option value="ARS">Peso Argentino - ARS</option>
                    <option value="ZAR">Rand Sul-Africano - ZAR</option>
                    <option value="BRL">Real Brasileiro - BRL</option>
                </select>
            </div>
        </div>  <!--/form-group row-->

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Valor em Moeda Estrangeira:</label>
            <div>
            <input class="form-control mascaradinheiro" name="valorOperacao" id="valorOperacao" placeholder="$ 0,00" maxlength="22" type="text">
            </div>
        </div>  <!--/form-group row-->

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Data Prevista de Embarque:</label>
            <div>
            <input class="form-control mascaradata" name="dataPrevistaEmbarque" id="dataPrevistaEmbarque" placeholder="DD/MM/AAAA" maxlength="10" type="text">
            </div>
        </div>  <!--/form-group row-->



        <hr>
        
        <div id="2" class="form-group desc3" style="">

            <div class="form-group">
                <fieldset class="form-group">
                    <div class="row">
                    
                    <label class="col-sm-2 col-form-label">Os dados da conta do destinatário estão no documento enviado?</label>
                    <div class="col-sm-10">
                        <div class="form-check form-check-inline">
                        <input class="form-check-input" name="temContaBeneficiarioAntecipado" id="temContaBeneficiarioAntecipadoSim" value="2" type="radio">
                        <label class="form-check-label">Sim</label>
                        </div>
                        <div class="form-check form-check-inline">
                        <input class="form-check-input" name="temContaBeneficiarioAntecipado" id="temContaBeneficiarioAntecipadoNao" value="3" type="radio">
                        <label class="form-check-label">Não</label>
                        </div>
                    </div>  <!--/col-->
                    </div>  <!--/row-->
                </fieldset>
    
                <div id="contaBeneficiarioAntecipado3" class="form-group row desc2" style="display: none;">
                    <label class="col-sm-2 col-form-label">Informe os dados bancários do beneficiário:</label>
                    <div class="col-sm-6">
                    <input class="form-control" id="nomeBeneficiarioAnt" name="nomeBeneficiario" placeholder="Nome do Beneficiário" type="text">
                    <input class="form-control" id="nomeBancoAnt" name="nomeBanco" placeholder="Nome do Banco Beneficiário" type="text">
                    <input class="form-control" id="ibanAnt" name="iban" placeholder="IBAN" type="text">
                    <input class="form-control" id="AgContaBeneficiarioAnt" name="AgContaBeneficiario" placeholder="Conta" type="text">
                    </div>
                </div>  <!--/contaBeneficiarioAnt-->
            </div>  <!--/form-group-->
        
            
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Documentação Necessária:</label>
            <div class="col">
                <ul class="list-group col-sm-9">
                    <li class="list-group-item padding18">- Invoice assinada</li>
                    <li class="list-group-item padding18">- Dados bancários</li>
                    <li class="list-group-item padding18">- Autorização SR</li>
                </ul>
            </div>  <!--/col-->

            <div class="col">


                <ul class="list-group col-sm-18">
                    <li class="list-group-item">

                        <div class="input-group">
                            <label class="input-group-btn">
                                <span class="btn btn-secondary"> <i class="fa fa-lg fa-cloud-upload"></i>
                                    Carregar arquivo… <input accept=".pdf,.jpg,.jpeg,.png" style="display: none;" name="invoice_[]" id="invoiceImpAnt" multiple="" required="required" type="file">
                                </span>
                            </label>
                            <input class="form-control" readonly="" type="text">
                        </div>

                        <!-- <div class="custom-file">
                            <input type="file" name="invoice_" id="invoiceImpAnt" class="custom-file-input">
                            <label class="custom-file-label"><i class="fa fa-lg fa-cloud-upload"></i>  Upload do arquivo.</label>
                        </div> -->
                    </li>                     

                    <li class="list-group-item">

                        <div class="input-group">
                            <label class="input-group-btn">
                                <span class="btn btn-secondary"> <i class="fa fa-lg fa-cloud-upload"></i>
                                    Carregar arquivo… <input accept=".pdf,.jpg,.jpeg,.png" style="display: none;" name="dados_bancarios_[]" id="dadosImpAnt" multiple="" type="file">
                                </span>
                            </label>
                            <input class="form-control" readonly="" type="text">
                        </div>    

                        <!-- <div class="custom-file">
                            <input type="file" name="dados_bancarios_" id="dadosImpAnt" class="custom-file-input">
                            <label class="custom-file-label"><i class="fa fa-lg fa-cloud-upload"></i>  Upload do arquivo.</label>
                        </div> -->
                    </li>  

                    <li class="list-group-item">

                        <div class="input-group">
                            <label class="input-group-btn">
                                <span class="btn btn-secondary"> <i class="fa fa-lg fa-cloud-upload"></i>
                                    Carregar arquivo… <input accept=".pdf,.jpg,.jpeg,.png" style="display: none;" name="aut_sr_[]" id="autSrImpAnt" multiple="" required="required" type="file">
                                </span>
                            </label>
                            <input class="form-control" readonly="" type="text">
                        </div>
    
                        <!-- <div class="custom-file">
                            <input type="file" name="aut_sr_" id="autSrImpAnt" class="custom-file-input">
                            <label class="custom-file-label"><i class="fa fa-lg fa-cloud-upload"></i>  Upload do arquivo.</label> -->
                    </li>                        
                </ul>
            </div>  <!--/col-->
        </div><!--/form-group row-->
            
        </div>  <!--/#2-->

        <div id="3" class="form-group desc3" style="display: none;">

            <div class="form-group">
                <fieldset class="form-group">
                    <div class="row">
                    
                    <label class="col-sm-2 col-form-label">Os dados da conta do destinatário estão no documento enviado?</label>
                    <div class="col-sm-10">
                        <div class="form-check form-check-inline">
                        <input class="form-check-input" name="temContaBeneficiarioNormal" id="temContaBeneficiarioNormalSim" value="2" type="radio">
                        <label class="form-check-label">Sim</label>
                        </div>
                        <div class="form-check form-check-inline">
                        <input class="form-check-input" name="temContaBeneficiarioNormal" id="temContaBeneficiarioNormalNao" value="3" type="radio">
                        <label class="form-check-label">Não</label>
                        </div>
                    </div>  <!--/col-->
                    </div>  <!--/row-->
                </fieldset>
    
                <div id="contaBeneficiarioNormal3" class="form-group row desc2" style="display: none;">
                    <label class="col-sm-2 col-form-label">Informe os dados bancários do beneficiário:</label>
                    <div class="col-sm-6">
                    <input class="form-control" id="iban1" name="nomeBeneficiario" placeholder="Nome do Beneficiário" type="text">
                    <input class="form-control" id="iban2" name="nomeBanco" placeholder="Nome do Banco Beneficiário" type="text">
                    <input class="form-control" id="iban3" name="iban" placeholder="IBAN" type="text">
                    <input class="form-control" id="iban4" name="AgContaBeneficiario" placeholder="Conta" type="text">
                    </div>
                </div>  <!--/contaBeneficiarioNormal-->
            </div>  <!--/form-group-->                    

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Documentação Necessária:</label>
            <div class="col">
                <ul class="list-group col-sm-9">
                    <li class="list-group-item padding18">- Invoice</li>
                    <li class="list-group-item padding18">- Conhecimento de Embarque</li>
                    <li class="list-group-item padding18">- Declaração de Importação (DI)</li>
                    <li class="list-group-item padding18">- Dados bancários</li>
                    <li class="list-group-item padding18">- Autorização SR</li>
                </ul>
            </div>  <!--/col-->

            <div class="col">
                <ul class="list-group col-sm-18">
                    <li class="list-group-item">
                        <div class="input-group">
                            <label class="input-group-btn">
                                <span class="btn btn-secondary"> <i class="fa fa-lg fa-cloud-upload"></i>
                                    Carregar arquivo… <input accept=".pdf,.jpg,.jpeg,.png" style="display: none;" name="invoice_[]" id="invoiceImp" multiple="" type="file">
                                </span>
                            </label>
                            <input class="form-control" readonly="" type="text">
                        </div>
                    </li>

                    <li class="list-group-item">
                        <div class="input-group">
                            <label class="input-group-btn">
                                <span class="btn btn-secondary"> <i class="fa fa-lg fa-cloud-upload"></i>
                                    Carregar arquivo… <input accept=".pdf,.jpg,.jpeg,.png" style="display: none;" name="embarque_[]" id="embarqueImp" multiple="" type="file">
                                </span>
                            </label>
                            <input class="form-control" readonly="" type="text">
                        </div>
                    </li>

                    <li class="list-group-item">
                        <div class="input-group">
                            <label class="input-group-btn">
                                <span class="btn btn-secondary"> <i class="fa fa-lg fa-cloud-upload"></i>
                                    Carregar arquivo… <input accept=".pdf,.jpg,.jpeg,.png" style="display: none;" name="di_[]" id="di" multiple="" type="file">
                                </span>
                            </label>
                            <input class="form-control" readonly="" type="text">
                        </div>
                    </li>

                    <li class="list-group-item">
                        <div class="input-group">
                            <label class="input-group-btn">
                                <span class="btn btn-secondary"> <i class="fa fa-lg fa-cloud-upload"></i>
                                    Carregar arquivo… <input accept=".pdf,.jpg,.jpeg,.png" style="display: none;" name="dados_bancarios_[]" id="dadosImp" multiple="" type="file">
                                </span>
                            </label>
                            <input class="form-control" readonly="" type="text">
                        </div>
                    </li>

                    <li class="list-group-item">
                        <div class="input-group">
                            <label class="input-group-btn">
                                <span class="btn btn-secondary"> <i class="fa fa-lg fa-cloud-upload"></i>
                                    Carregar arquivo… <input accept=".pdf,.jpg,.jpeg,.png" style="display: none;" name="aut_sr_[]" id="autSrImp" multiple="" type="file">
                                </span>
                            </label>
                            <input class="form-control" readonly="" type="text">
                        </div>
                    </li>                        
                </ul>
            </div>  <!--/col-->
        </div><!--/form-group row-->

            
        </div>  <!--/#3-->

        <div id="4" class="form-group row desc3" style="display: none;">          
            <label class="col-sm-2 col-form-label">Documentação Necessária:</label>
            <div class="col">
                <ul class="list-group col-sm-9">
                    <li class="list-group-item padding18">- Invoice assinada</li>
                    <li class="list-group-item padding18">- Autorização SR</li>
                </ul>
            </div>  <!--/col-->

            <div class="col">
                <ul class="list-group col-sm-18">
                    <li class="list-group-item">
                        <div class="input-group">
                            <label class="input-group-btn">
                                <span class="btn btn-secondary"> <i class="fa fa-lg fa-cloud-upload"></i>
                                    Carregar arquivo… <input accept=".pdf,.jpg,.jpeg,.png" style="display: none;" name="invoice_[]" id="invoiceExpAnt" multiple="" type="file">
                                </span>
                            </label>
                            <input class="form-control" readonly="" type="text">
                        </div>
                    </li>

                    <li class="list-group-item">
                        <div class="input-group">
                            <label class="input-group-btn">
                                <span class="btn btn-secondary"> <i class="fa fa-lg fa-cloud-upload"></i>
                                    Carregar arquivo… <input accept=".pdf,.jpg,.jpeg,.png" style="display: none;" name="aut_sr_[]" id="autSrExpAnt" multiple="" type="file">
                                </span>
                            </label>
                            <input class="form-control" readonly="" type="text">
                        </div>
                    </li>                        
                </ul>
            </div>  <!--/col-->
        </div>  <!--/#4-->

        <div id="5" class="form-group row desc3" style="display: none;">          
            <label class="col-sm-2 col-form-label">Documentação Necessária:</label>
            <div class="col">
                <ul class="list-group col-sm-9">
                    <li class="list-group-item padding18">- Invoice</li>
                    <li class="list-group-item padding18">- Conhecimento de Embarque</li>
                    <li class="list-group-item padding18">- Declaração Única de Exportação (DU-E)</li>
                    <li class="list-group-item padding18">- Autorização SR</li>
                </ul>
            </div>  <!--/col-->

            <div class="col">
                <ul class="list-group col-sm-18">
                    <li class="list-group-item">
                        <div class="input-group">
                            <label class="input-group-btn">
                                <span class="btn btn-secondary"> <i class="fa fa-lg fa-cloud-upload"></i>
                                    Carregar arquivo… <input accept=".pdf,.jpg,.jpeg,.png" style="display: none;" name="invoice_[]" id="invoiceExp" multiple="" type="file">
                                </span>
                            </label>
                            <input class="form-control" readonly="" type="text">
                        </div>
                    </li>

                    <li class="list-group-item">
                        <div class="input-group">
                            <label class="input-group-btn">
                                <span class="btn btn-secondary"> <i class="fa fa-lg fa-cloud-upload"></i>
                                    Carregar arquivo… <input accept=".pdf,.jpg,.jpeg,.png" style="display: none;" name="embarque_[]" id="embarqueExp" multiple="" type="file">
                                </span>
                            </label>
                            <input class="form-control" readonly="" type="text">
                        </div>
                    </li>

                    <li class="list-group-item">
                        <div class="input-group">
                            <label class="input-group-btn">
                                <span class="btn btn-secondary"> <i class="fa fa-lg fa-cloud-upload"></i>
                                    Carregar arquivo… <input accept=".pdf,.jpg,.jpeg,.png" style="display: none;" name="due_[]" id="due" multiple="" type="file">
                                </span>
                            </label>
                            <input class="form-control" readonly="" type="text">
                        </div>
                    </li>

                    <li class="list-group-item">
                        <div class="input-group">
                            <label class="input-group-btn">
                                <span class="btn btn-secondary"> <i class="fa fa-lg fa-cloud-upload"></i>
                                    Carregar arquivo… <input accept=".pdf,.jpg,.jpeg,.png" style="display: none;" name="aut_sr_[]" id="autSrExp" multiple="" type="file">
                                </span>
                            </label>
                            <input class="form-control" readonly="" type="text">
                        </div>        
                    </li>                        
                </ul>
            </div>  <!--/col-->

        </div>  <!--/#5-->
            

        <input id="matricula" name="matricula" type="hidden"> 
        


        <div class="form-group row">
            <div class="col-sm-2">
            <button type="submit" name="submit" id="submitBtn" class="btn btn-secondary">Enviar</button>
            </div>
        </div>
    
    </form>
    
</div>

</div>



@stop






@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('####################### OLAH #####################'); </script>
@stop