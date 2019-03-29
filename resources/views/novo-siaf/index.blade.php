<!DOCTYPE html>
    <html lang="pt">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1"> 
    
    <title>SUPOC - SN Produtos Corporativos</title>
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" /> 
  
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"> 
    <link href="{{ asset('css/template.css') }}" rel="stylesheet" type="text/css">  
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/icons.css') }}" rel="stylesheet" type="text/css">
    <!-- <link href="{{ asset('css//wysihtml5/wysiwyg-color.css') }}" rel="stylesheet" type="text/css"> -->
    <link href="{{ asset('css/font-awesome-4.5.0/font-awesome-4.5.0/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/index.css') }}" rel="stylesheet" type="text/css">
    <!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=latin,cyrillic-ext" rel="stylesheet" type="text/css"> -->

    <script src="{{ asset('js/plugins/jquery/jquery-1.12.1.min.js')}}"></script>
    <script src="{{ asset('js/plugins/jquery/jquery-ui.min.js')}}"></script>

    <!-- <style>
  
  .table-hover > tbody > tr:hover{
  color: #1c60ab;  
    
  }
  


</style> -->
</head>

<body>

	<!-- Navbar cabeçalho -->
	<div class="navbar navbar-inverse" role="navigation">
		<div class="navbar-header">
			<a class="navbar-brand" href="#">SUPOC</a>
			<a class="sidebar-toggle"><i class="icon-paragraph-justify2"></i></a>
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-icons">
				<span class="sr-only">Toggle navbar</span>
				<i class="icon-grid3"></i>
			</button>
			<button type="button" class="navbar-toggle offcanvas">
				<span class="sr-only">Toggle navigation</span>
				<i class="icon-paragraph-justify2"></i>
			</button>
		</div>

        	<ul class="nav navbar-nav navbar-right collapse" id="navbar-icons">
		
			<li class="user dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown"><span></span><i class="caret"></i></a>
				<ul class="dropdown-menu dropdown-menu-right">
					<li><a href="#">Nome: </a></li>
					<li><a href="#">Matrícula:</a></li>
					<li><a href="#">Função: </a></li>
					<li><a href="#">Lotação: </a></li>
					<li><a href="#" id="grupo">Grupo:  </a></li>
				</ul>
			</li>
		</ul>
	</div>


	<!-- Page container -->
 	<div class="page-container">


<!-- Sidebar -->
<div class="sidebar">
    <div class="sidebar-content">

        <!-- User dropdown -->
        
        <div class="user-menu dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <div class="user-info"><b>SIAF - Sistema de Acompanhamento de Fluxo</b></div>
        </a>
        <div class="popup dropdown-menu dropdown-menu-right">
            <ul class="list-group">
                <li class="list-group-item">
                    <i class="icon-pencil3 text-muted"></i><a href="/novosiaf/documentos"><span>Lista de Documentos</span></a>
                </li>
            </ul>
        </div>
    </div>
        
        <!-- /user dropdown -->


        <!-- Main navigation menu lateral -->
        <ul id="menu-principal" class="navigation">
        <li id="menu-dashboard"><a href="http://www.sumep.mz.caixa/novosiaf/"><span>Dashboard</span><i class="icon-screen2"></i></a></li>
        <li id="menu-documentos"><a href="http://www.sumep.mz.caixa/novosiaf/documentos"><span>Documentos</span><i class="icon-pencil3"></i></a></li>     
        <li id="menu-digitalizacao"><a href="#" class="expand"><span>Digitalização</span><i class="icon-upload3"></i></a>
            <ul>
                <li id="menu-digitalizacao-avalop"><a href="http://www.sumep.mz.caixa/novosiaf/digitalizacao">Inserir AVALOP</a></li>
                <li id="menu-digitalizacao-sict2"><a href="http://sistemas.retaguarda.caixa/filaunica/" target="_blank">SICT2 (Digitalização dos Documentos)</a></li>
            </ul>
        </li>
        <li id="menu-contratos"><a href="#" class="expand"><span>Contratos</span><i class="icon-paragraph-justify2"></i></a>
            <ul>
                <li id="menu-contratos-buscar"><a href="http://www.sumep.mz.caixa/novosiaf/contrato/buscar">Buscar Contrato</a></li>
                <li id="menu-contratos-inserir"><a href="http://www.sumep.mz.caixa/novosiaf/contrato/inserir">Inserir Contrato</a></li>
                <li id="menu-contratos-minha-fila"><a href="http://www.sumep.mz.caixa/novosiaf/contrato/fila_analista">Minha Fila de Atendimento</a></li>
                <li id="menu-contratos-refinanciamento"><a href="http://www.sumep.mz.caixa/novosiaf/refinanciamento/index">Refinanciamento de Contratos</a></li>
            </ul>
        </li>
        <li id="menu-indicadores"><a href="#" class="expand"><span>Indicadores</span><i class="icon-bars"></i></a>
            <ul>
                <li id="menu-indicadores-prazo-medio"><a href="http://www.sumep.mz.caixa/novosiaf/indicador/prazo_medio">Prazo Médio das Etapas do Processo</a></li>
                <li id="menu-indicadores-analise-esteiras"><a href="http://www.sumep.mz.caixa/novosiaf/indicador/analise_esteiras">Prazo de Análise das Esteiras</a></li>
                <li id="menu-indicadores-evolucao"><a href="http://www.sumep.mz.caixa/novosiaf/indicador/evolucao">Evolução</a></li>
            </ul>
        </li>
        <li id="menu-relatorios-sr"><a href="#" class="expand"><span>Relatórios SR</span><i class="icon-bars"></i></a>
            <ul>
                <li id="menu-relatorios-sr-movimentacao"><a href="http://www.sumep.mz.caixa/novosiaf/relatoriossr/relatorio_movimentos">Relatório de Movimentação</a></li>
                <li id="menu-relatorios-sr-correcao"><a href="http://www.sumep.mz.caixa/novosiaf/relatoriossr/relatorio_correcao_sr">Relatório de Dias para Correção</a></li>
                <li id="menu-relatorios-sr-pacsempl"><a href="http://www.sumep.mz.caixa/novosiaf/relatoriossr/relatorio_pac_sem_pl">Relatório PAC/FRO Aprovadas sem PL</a></li>
            </ul>
        </li>
        <li id="menu-relatorios-cnbndes"><a href="#" class="expand"><span>Relatórios CNBNDES</span><i class="icon-bars"></i></a>
            <ul>
                <li id="menu-relatorios-cnbndes-incluidos"><a href="http://www.sumep.mz.caixa/novosiaf/relatorioscnbndes/relatorio_incluidos">Incluídos</a></li>
                <li id="menu-relatorios-cnbndes-aprov-lib"><a href="http://www.sumep.mz.caixa/novosiaf/relatorioscnbndes/relatorio_aprov_lib">Aprovados e Liberados</a></li>
                <li id="menu-relatorios-cnbndes-aguardando"><a href="http://www.sumep.mz.caixa/novosiaf/relatorioscnbndes/relatorio_aguardando">Aguardando Aprovação/Liberação</a></li>
                <li id="menu-relatorios-cnbndes-recusas"><a href="http://www.sumep.mz.caixa/novosiaf/relatoriosconsolidado/relatorio_recusas">PAC/FRO e PLs Recusados</a></li>
                <li id="menu-relatorios-cnbndes-abaixo100k"><a href="http://www.sumep.mz.caixa/novosiaf/relatoriosconsolidado/relatorio_abaixo100k">Contratos Abaixo de R$ 100 Mil</a></li>
                <li id="menu-relatorios-cnbndes-pendencias"><a href="http://www.sumep.mz.caixa/novosiaf/relatoriosconsolidado/relatorio_pendencias">Pendências</a></li>
                <li id="menu-relatorios-cnbndes-indicador"><a href="http://www.sumep.mz.caixa/novosiaf/relatorioscnbndes/relatorio_indicador_demandas">Indicador de Tratamento de Demandas</a></li>
            </ul>
        </li>
        <li id="menu-simulador"><a href="http://www.sumep.mz.caixa/novosiaf/simulador"><span>Simulador BNDES</span><i class="icon-settings"></i></a></li>
        <li id="menu-convenios"><a href="http://www.sumep.mz.caixa/convenios/"><span>Acompanhamento de Convênios</span><i class="icon-truck"></i></a></li>
        <li id="menu-amortizacao"><a href="http://www.geopc.mz.caixa/sumep.mz.caixa/novosiaf/"><span>Amortização \ Liquidação</span><i class="icon-stackoverflow"></i></a></li>
    </ul>
        <!-- /main navigation -->
        
    </div>
</div>
<!-- /sidebar -->


<!-- Page content -->
 <div class="page-content">
<!----------------------CONTRUÇÃO DE MODAL--------------
###################################################################################################
###################################################################################################
####################################################################################################

-->
<!-- Large modal -->

 <div id="modalCadastramento" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" >
        
        <div class="modal-dialog modal-danger modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="icon-file-plus"></i>Solicitação de Amortização \ Liquidação  <span id="nome_cliente"></span>  <span id="cnpj_cliente"></h4>
                </div>
                
                
                <div class="modal-body with-padding">
                    <div class="tabbable">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tabSelecionar" data-toggle="tab"><i class="icon-checkbox-checked"></i>Selecionar Contratos</a></li>
                            <li><a href="#tabInstrucoes" data-toggle="tab"><i class="icon-book"></i>Instruções </a></li>
                            
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="tabSelecionar">
                            <div class="row"><small class="display-block " id="avisoAgencia"><strong> RATIFICAR AS INFORMAÇÕES CARREGADAS! No caso de dúvidas consulte as instruções de preenchimento no menu acima ! &nbsp &nbsp &nbsp </small></div></strong>
                            
                            <div class="row"><small class="display-block text-danger active" id ="avisoAgencia"> Para solicitar, Informe abaixo o nº BNDES, valor, confirme a conta, contrato e o tipo de comando dos contratos desejados e envie à CEOPC!  </small></div>
                            
                            <h5 class=""><span id="nome_cliente2"></span>  <span id="cnpj_cliente2"></span></h5>
                            
                                
                                <form class="form-group has-feedback" action="" method="post" role="form" id="formulario_pedido_amortizacao">
                            
                            
                                <input type="hidden" id="nome_cliente3"  name="nome_cliente3">
                                <input type="hidden" id="cnpj_cliente3" name="cnpj_cliente3">
                                
                                <div class="form-group">
                            
                                <table id ="tabCadastrar" class="table table-bordered table-striped datatable">
                                    <thead>
                                        <tr>
                                            
                                            <th>N Contrato BNDES</th>
                                            <th>N Contrato CAIXA</th>
                                            <th>Conta para Débito</th>
                                            <th>Valor (Valor amortização)</th>
                                            <th>Tipo de Comando</th>
                                        </tr>
                                    </thead>
                                    <tbody id="form_contratos">
                                        
                                    </tbody>
                                </table>
                            
                                <br>
                                
                             
                            <label>Observações</label>
                            <textarea class="form-control" rows="3"name="co_observacoes" placeholder="Digite as observações da solicitação aqui...."></textarea>  
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-danger pull-left fecha_e_refresh" data-dismiss="modal">Fechar</button>
                                <button class="btn btn-success pull-right cadamortizacao">Enviar à CEOPC</button>
                            </div>
                            </form>
                            </div>
                            
                            <div class="tab-pane body fade" id="tabInstrucoes">
                            <div class="row">
                            <div class="col-sm-12">
                                <h5 class="text-error">Passo a passo</h5>
                                <p> - Certifique-se que a amortização é referente ao cliente selecionado.</p>
                                <p> - Selecione o contrato que deseja solicitar amortização ou liquidação.</p>
                                <p> - <strong>Não é necessário preencher nada nos contratos que não serão amortizados/liquidados</strong>.</p>
                                <p> - <strong>Verifique se os dados dos contratos selecionados estão corretos, ajuste se necessário.</strong></p>
                                <p> - Informe o valor a amortizar.</p>
                                <p> - Ao valor da liquidação não deve ser somado a prestação do dia </p>
                                <p> - Selecione o tipo de comando.</p>
                                <p> - Preencha as observações pertinentes.</p>
                                <p> - Envie o pedido à CEOPC.</p>
                                <hr>
                                

                            </div>
                            </div>
                            </div>                       
                        
                    </div>
                </div>
                </div>

                
            </div>
        </div>
    </div>
    <!-- /large modal -->
    
    <!-- /Modal para visualizar contrato -->
    <div id="visualizarContrato" class="modal fade" tabindex="-1" role="dialog"  data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close fecha_e_refresh" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="icon-eye"></i> Visualizar Contrato</h4>
                </div>

                <div class="modal-body with-padding">
                    
                    <div class="tabbable">
                    
                       
                             <h5 class=""><span id="nome_cliente_modal"></span>  <span id="cnpj_cliente_modal"></h5>
                            
                                <form>
                            
                                <div class="form-group">
                            
                                
                             <br>             
                             <div class="row">  
                                    <div id="conteudoModal"></div>
                            <div class="col-sm-3">
                                <label class="control-label">N Contrato BNDES</label>
                                 <input placeholder="..."  id="contrato_bndes_modal"class="form-control" type="text" disabled>
                            </div>
                            <div class="col-sm-3">
                                <label class="control-label">N Contrato CAIXA</label>
                                 <input placeholder="..." id="contrato_caixa_modal" class="form-control" type="text" disabled>
                            </div>
                           
                            
                            
                            <div class="col-sm-3">
                                <label class="control-label">Conta para Débito</label>
                                 <input placeholder="..." id="conta_corrente_modal"class="form-control" type="text" disabled>
                            </div>
                            <div class="col-sm-3">
                                <label class="control-label">Valor da Amortização</label>
                                 <input placeholder="..." id="valor_modal" class="form-control" type="text" disabled>
                            </div>
                            </div>
                            <br>
                            <div class="row">    
                            <div class="col-sm-3">
                                <label class="control-label">Tipo de Comando</label>
                                <input placeholder="..." id="tipo_modal" class="form-control" type="text" disabled>
                            </div>
                            <div class="col-sm-3">
                                <label class="control-label">STATUS</label>
                                <input placeholder="..." id="status_modal" class="form-control" type="text" disabled>
                            </div>
                              <div class="col-sm-1">
                                <label class="control-label">PA</label>
                                 <input placeholder="..." id="pv_modal" class="form-control" type="text" disabled>
                            </div>
                              <div class="col-sm-1">
                                <label class="control-label">SR</label>
                                 <input placeholder="..." id="sr_modal" class="form-control" type="text" disabled>
                            </div>
                              <div class="col-sm-1">
                                <label class="control-label">GIGAD</label>
                                 <input placeholder="..." id="gigad_modal" class="form-control" type="text" disabled>
                            </div>
                            </div>
                                            
                                        
                                        
                            
                    <br>
                                                              
                                
                             
                              <label>Observações</label>
                             
                              <span class="editor form-control" id="obs_modal"></span>
                              <br>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h6 class="panel-title"><i class="icon-coin"></i> Histórico de saldo</h6>
                                </div>
                                
                                <div class="panel-body">
                                
                                  <table class="table table-bordered table-striped datatable">
                                    <thead>
                                        <tr>
                                            <th>Data e Hora</th>
                                            <th> Status </th>
                                            <th> Saldo Disponível </th>
                                            <th> Saldo Bloqueado </th>
                                            <th> Limite Disponível </th>
                                            <th> Saldo Total </th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody id="form_saldo_conta">
                                        
                                    </tbody>
                                </table>
                                
                                
                                </div>
                            </div>
            
                        
                              
                              </div>
                             
                            </form>
                            </div>
                            
                            
                           <div class="panel panel-default">
                               <div class="panel-heading">
                                   <h6 class="panel-title"><i class="icon-vcard"></i> Histórico do contrato</h6>
                               </div>
                               
                               <div class="panel-body">
                               
                                 <table class="table table-bordered table-striped datatable">
                                   <thead>
                                       <tr>
                                           <th>Data e Hora</th>
                                           <th> Status </th>
                                           <th> Observações </th>
                                           <th> Responsável </th>
                                                                                    
                                       </tr>
                                   </thead>
                                   <tbody >
                                       
                                   </tbody>
                               </table>
                               
                               
                               </div>
                           </div>
                        
                    </div>
                     <div class="modal-footer">
                                    <small class="pull-left"> Cadastrado em : <span id="datacadastramento"></span>, por  <span id="solicitante_nome"></span>  (<span id="solicitante_matricula"></span>) </small>
                                    <button class="btn btn-danger pull-right fecha_e_refresh" data-dismiss="modal">Fechar</button>
                                
                                
                            </div>
                
                    
                    
                    
                </div>

            </div>
        </div>
    
    <!-- /Modal para visualizar contrato -->
    
    <!-- /Modal para editar status -->
       <div id="editarcontrato" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close fecha_e_refresh" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="icon-eye"></i> Editar Contrato</h4>
                </div>
                
                <form class="form-group has-feedback" action="" method="post" role="form" id="formulario_editar_amortizacao">
                    <input type="hidden" id="protocolo_alterar_dados"  name="protocolo_alterar_dados">        
                    <input type="hidden" id="editar_contrato_bndes_antigo" name="editar_contrato_bndes_antigo">   
                    <input type="hidden" id="editar_contrato_caixa_antigo" name="editar_contrato_caixa_antigo">   
                    <input type="hidden" id="editar_conta_antigo" name="editar_conta_antigo">   
                    <input type="hidden" id="editar_valor_antigo" name="editar_valor_antigo">   
                    <input type="hidden" id="editar_status_antigo" name="editar_status_antigo">   

                <div class="modal-body with-padding">
                    
                    <div class="tabbable">
                       
                        
                           
                            
                            <h5 class=""><span id="nome_cliente_editar"></span>  <span id="cnpj_cliente_editar"></h5>
                            
                                <form>
                            
                                <div class="form-group">
                                
                                
                              <br>             
                             <div class="row">  
                                    <div id="conteudoModal"></div>
                            <div class="col-sm-3">
                                <label class="control-label">N Contrato BNDES</label>
                                 <input placeholder="..."  data-mask="99999999999" name="contrato_bndes_editar" id="contrato_bndes_editar"class="form-control" type="text" >
                            </div>
                            <div class="col-sm-3">
                                <label class="control-label">N Contrato CAIXA</label>
                                 <input placeholder="..." name="contrato_caixa_editar" id="contrato_caixa_editar" data-mask="9999.999.9999999-99" class="form-control" type="text" >
                            </div>
                           
                            
                            
                            <div class="col-sm-3">
                                <label class="control-label">Conta para Débito</label>
                                 <input placeholder="..." data-mask="9999.999.99999999-9" name="conta_corrente_editar" id="conta_corrente_editar"class="form-control" type="text" >
                            </div>
                            <div class="col-sm-3">
                                <label class="control-label">Valor</label>
                                 <input placeholder="..." name="valor_editar" id="valor_editar" valoreditar class="form-control" type="text" >
                            </div>
                            </div>
                            <br>
                            <div class="row">    
                            <div class="col-sm-3">
                                <label class="control-label">Tipo de Comando</label>
                                <input placeholder="..." id="tipo_editar" class="form-control" type="text" disabled>
                            </div>
                            <div class="col-sm-3">
                                <label class="control-label">STATUS</label>
                               
                                
                                <div id="form_status_editar"></div>
                                
                                
                            </div>
                             <div class="col-sm-2">
                                <label class="control-label">PV</label>
                                <input placeholder="..." id="pv_editar" class="form-control" type="text" disabled>
                            </div>
                              <div class="col-sm-2">
                                <label class="control-label">SR</label>
                                 <input placeholder="..." id="sr_editar" class="form-control" type="text" disabled>
                            </div>
                              <div class="col-sm-2">
                                <label class="control-label">GIGAD</label>
                                 <input placeholder="..." id="gigad_editar" class="form-control" type="text" disabled>
                            </div>
                            </div>
                            
                                            
                                        
                                        
                            
                                <br>
                                
                                
                                
                             
                              <label>Observações</label>
                             
                              <textarea class="editor form-control" rows="3"name="co_observacoes" placeholder="Digite as observações da solicitação aqui...."></textarea> 
                              <br>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h6 class="panel-title"><i class="icon-coin"></i> Histórico de saldo</h6>
                                </div>
                                <div class="panel-body">
                                
                                  <table class="table table-bordered table-striped datatable">
                                    <thead>
                                        <tr>
                                            <th> Data e Hora</th>
                                            <th> Status </th>
                                            <th> Saldo Disponível </th>
                                            <th> Saldo Bloqueado </th>
                                            <th> Limite Disponível </th>
                                            <th> Saldo Total </th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody id="form_saldo_conta_2">
                                        
                                    </tbody>
                                </table>
                                
                                
                                
                                </div>
                            </div>
            
                        
                              
                              </div>
                             
                            </form>
                            </div>
                      
                            <div class="panel panel-default">
                               <div class="panel-heading">
                                   <h6 class="panel-title"><i class="icon-vcard"></i> Histórico do contrato</h6>
                               </div>
                               
                               <div class="panel-body">
                               
                                 <table class="table table-bordered table-striped datatable">
                                   <thead>
                                       <tr>
                                           <th>Data e Hora</th>
                                           <th> Status </th>
                                           <th> Observações </th>
                                           <th> Responsável </th>
                                                                                    
                                       </tr>
                                   </thead>
                                   <tbody >
                                       
                                   </tbody>
                               </table>
                               
                               
                               </div>
                           </div>
                        
                    </div>
                    <div class="modal-footer">
                    <small class="pull-left"> Cadastrado em : <span id="editardatacadastramento"></span>, por  <span id="editarsolicitante_nome"></span>  (<span id="editarsolicitante_matricula"></span>) </small>
                            <button class="btn btn-default btn-success pull-right mandei_editar  fecha_e_refresh" data-dismiss="modal">Enviar á CEOPC </button>
                            <span class="pull-right"> </span>
                                <button class="btn btn-default btn-danger pull-right fecha_e_refresh" data-dismiss="modal">Fechar</button> 
                                
                    </div>
                    </form>
                
                    
                    
                    
                </div>

            </div>
        </div>
    <!-- /Modal para editar status -->
    
    <!-- /Modal para excluir-->
    
    <div id="excluirpedido" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close fecha_e_refresh" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="icon-accessibility"></i> Excluir </h4>
                </div>

                <div class="modal-body with-padding">
                    <p>Deseja Excluir o pedido #<span id="confirma_excluir_protocolo"></span> <br>do contrato <span id="contrato_cliente_modal_excluir"></span><br>  do cliente <span id="nome_cliente_modal_excluir"></span> &nbsp ?</p>
                </div>
                <form class="form-group has-feedback" action="" method="post" role="form" id="formulario_excluir">
                <input type="hidden" id="excluir_protocolo"  name="exluirestepedido">
                <div class="modal-footer">
                    <button class="btn btn-warning fecha_e_refresh" data-dismiss="modal">Fechar</button>
                    <button class="btn btn-success exclui_apos_confirmacao" >Excluir </button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Modal para excluir -->
    
    
      <!-- /Modal para excluir-->
    
    <div id="confirmacao" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close fecha_e_refresh" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="icon-checkmark"></i>Dados Cadastrados com sucesso!!</h4>
                </div>

                <div class="modal-body with-padding">
                    <p>Consulte em seus pedidos os protocolos gerados e acompanhe o processo de amortização.</p>
                </div>

                <div class="modal-footer">
                    
                    <button class="btn btn-success fecha_e_refresh">OK</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /Modal para excluir-->

    
     
    
<!-- --------------------CONTRUÇÃO DE MODAL--------------
###################################################################################################
###################################################################################################
#################################################################################################### -->



    <!-- Page header -->
    <div class="page-header">
        <div class="page-title">
            <h3 >Amortização \ Liquidação <small>Bem Vindo  </small></h3>
        </div>

    </div>
    <!-- /page header -->


    <!-- Breadcrumbs line -->
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="index.html">Amortização - Liquidação </a></li>
            <li class="active"></li>
        </ul>
    </div>
    
    <!-- <div class="block">
    <div class="row">
            
                <div class="col-md-3">
                <button class="btn btn-info active animated bounce" data-toggle="collapse" data-target="#abrircnpj"> <b class="icon icon-file-plus  "> </b>  Solicitar Amortização \ Liquidação </button>
                </div> 
    </div>
    
     
    <div class="row">
    <form class="form-group has-feedback" action="" method="post" role="form" id="formulario_cnpj">
                        <div class="form-group active animated bounce collapse" id="abrircnpj">
                            <br>
                            <div class="col-md-4">
                                <div class="input-group">
                                <span class="input-group-addon"><b>CNPJ : </b></span>
                                <b><input maxlength="18" data-mask="99.999.999/9999-99" data-original-title="Digite o cnpj e pressione OK" id="cnpj" name="cnpj" class="form-control tip" data-toggle="tooltip" data-trigger="focus" title="" type="text"></b>
                                    
                                    <span class="input-group-btn">
                                    
                                    <button class="btn btn-info tip carregadadoscnpj " title="Enviar"  type="button">OK <b class="fa fa-chevron-right animated flash infinite "> </b><b class="fa fa-chevron-right animated flash infinite "> </b></button>
                                    
                                    </span>
                                </div>
                            </div>
                        </div>	
                        </form>
    
    </div>
    
    <br>
     -->
    <!-- tabelas -->

    <!-- cabecalho tabela -->

         
    <div class="tabbable page-tabs">
        <ul class="nav nav-tabs">
            <li class="active">
            <a href="#contratosliquidar" data-toggle="tab"><i class="icon-paragraph-justify2"></i> Contratos a liquidar         </a></li>
            <li><a href="#amortizaprox" data-toggle="tab"><i class="icon-exit4"></i> Amortizações para o próximo Lote         </a></li>
            <li><a href="#amortizaant" data-toggle="tab"><i class="icon-exit3"></i> Amortizações do Lote Anterior</a></li>
            <li><a href="#SUMEP" data-toggle="tab"><i class="icon-hammer"></i>Contratos na SUMEP</a></li>
            <li><a href="#amortizatodas" data-toggle="tab"><i class="icon-file4"></i>Todas solicitações de Amortização </a></li>
        </ul>

    <!-- conteudo tabelas -->

    
        <!-- tabela contratos agência -->
        <div class="tab-content">
        
            <div class="tab-pane active fade in" id="contratosliquidar">

            <p><strong>Amortizações referentes ao lote: </strong></p>
                <!-- Default datatable inside panel -->
                <div class="panel panel-default">
                <div class="panel-heading"><h6 class="panel-title"><i class="icon-table"></i> Contratos da agência:  x </h6></div>
                    <!-- <div> -->
                        <table id="tabelaContratosLiquidar" class="table  table-striped table-hover">
                            <thead>
                                <tr>
                                    <!-- <th>Contrato CAIXA</th> -->
                                    <th>Tomador</th>                             
                                    <th>CNPJ</th>
                                    <th>Solicitar liquidação/amortização</th>
                                    <!-- <th></th> -->
                                </tr>
                                        
                            </thead>

                                <tbody>

                                        
                                </tbody>
                        </table>
                     <!-- </div> -->
                </div>
                    
            </div>

     <!-- tabela contratos tratamento ceopc -->
        
            <div class="tab-pane" id="amortizaprox">
            <p><strong>Amortizações referentes ao lote: </strong></p>
                <!-- Default datatable inside panel -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h6 class="panel-title"><i class="icon-table"></i> Lista de solicitações referentes ao lote : </h6>
                        </div>
                    <div class="datatable">
                        <table id="tabelaAmortizaProx" class="table  table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#COD</th>
                                    <th>Tomador</th>
                                    <th>Ctr CAIXA</th>
                                    <th>Ctr BNDES</th>
                                    <th>Conta</th>
                                    <th>Valor</th>
                                    <th>Comando</th>
                                    <th>Status</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                                <tbody>
                                   
                                    
                                </tbody>
                        </table>
                    </div>
                </div>
                    
            </div>
            

            <!-- contratos lote anterior -->
            <div class="tab-pane" id="amortizaant">
            <p><strong>Amortizações referentes ao lote: </strong></p>
                    <!-- Default datatable inside panel -->
                    <div class="panel panel-default">
                            <div class="panel-heading">
                                <h6 class="panel-title">
                                <i class="icon-table"></i>  Lista de solicitações referentes ao lote : </h6>
                            </div>

                            <div class="datatable">
                                    <table id="tabelaLoteAnterior" class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>#COD</th>
                                                <th>Tomador</th>
                                                <th>Ctr CAIXA</th>
                                                <th>Ctr BNDES</th>
                                                <th>Conta</th>
                                                <th>Valor</th>
                                                <th>Comando</th>
                                                <th>Status</th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                            </div>
                    </div>
                    
            </div>
            

<!-- inicio teste de inclusão da aba da SUMEP -->

        <div class="tab-pane" id="SUMEP">

                    <!-- Default datatable inside panel -->
                    <div class="panel panel-default">
                            <div class="panel-heading">
                                <h6 class="panel-title">
                                <i class="icon-table"></i>  Lista de solicitações com análise Pendente pela SUMEP:</h6>
                            </div>

                            <div class="datatable">
                                    <table id="tabelaSumep" class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>#COD</th>
                                                <th>Tomador</th>
                                                <th>Ctr CAIXA</th>
                                                <th>Ctr BNDES</th>
                                                <th>Lote Rotina</th>
                                                <th>Valor</th>
                                                <th>Comando</th>
                                                <th>Status</th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                         
                                        
                                        </tbody>
                                    </table>
                            </div>
                    </div>
                    
            </div>
            
<!-- fim do teste inclusão da aba da SUMEP -->


            
            <div class="tab-pane" id="amortizatodas">

            <div class="tabbable page-tabs">
        <ul class="nav nav-tabs" id="tabela-pesquisa">
            <li class="active">
            <a href="#listasolicitacoes" data-toggle="tab"><i class="icon-table"></i>Lista de solicitações por Lote</a></li>
            <li><a href="#pesquisasolicitacoes" data-toggle="tab"><i class="icon-table"></i>Pesquisa liquidação/amortização</a></li>
                      
        </ul>

        <div class="tab-content">
        
            <div class="tab-pane active fade in" id="listasolicitacoes">

            <!-- Default datatable inside panel -->
                <div class="panel panel-default">
                
                    <div class="datatable">
                        <table id="tabelaListaSolicitacoes" class="table  table-striped table-hover">
                            <thead>
                                <tr>
                                <th align="center">Lote</th>
                                        <th align="center">Quantidade Solicitada</th>
                                        <th align="center">Quantidade Acatada</th>
                                        <th align="center">Valor do Lote</th>
                                        <th></th>
                                </tr>
                                        
                            </thead>

                                <tbody>

                                        
                                </tbody>
                        </table>
                    </div>
                </div>
                
            </div>

            <div class="tab-pane" id="pesquisasolicitacoes">

                        <!-- Default datatable inside panel -->
                        <div class="panel panel-default">
                        
                                <div class="datatable">
                                    <table id="tabelaPesquisaSolicitacoes" class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th align="center">CNPJ</th>
                                                <th align="center">Tomador</th>
                                                <th align="center">Valor</th>
                                                <th align="center">Status</th>
                                                <th align="center">Lote</th>
                                            <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        
                                        
                                        </tbody>
                                    </table>
                                </div>
                        </div>
                        
            </div>

          
                 
        </div> 
    </div>







        </div>
    </div>
    
    
    
    <!--DUVIDAS FREQUENTES-->
     <div class="row">
     <br>
     <br>
     <br>
        <div class="col-md-6">

            <!-- Questions -->
            <h6><i class="icon-question5"></i> Dúvidas Frequentes na Amortização \ Liquidação</h6>
            <div class="panel-group block">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h6 class="panel-title panel-trigger">
                            <a data-toggle="collapse" href="#question1">1. O que mudou na Amortização?</a>
                        </h6>
                    </div>
                    <div id="question1" class="panel-collapse collapse">
                        <div class="panel-body">
                            <p class="alert alert-success fade in text-center">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                Mudamos a forma de atuar com intuito de proporcionar a melhor experiência ao usuário.
                            </p>		
                            <hr>							
                            <p><strong>Agora as solicitações de amortização geram um protocolo de pedido que pode ser facilmente acompanhado.</strong></p>
                            Você pode clicar no botão para visualização de pedidos e lá tem o histórico de atuação na demanda.
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h6 class="panel-title panel-trigger">
                            <a data-toggle="collapse" href="#question2">2. O que eu devo fazer para amortizar ou liquidar um contrato?</a>
                        </h6>
                    </div>
                    <div id="question2" class="panel-collapse collapse">
                        <div class="panel-body">
                            <p class="alert alert-success fade in text-center">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                É facil, no menu de amortização você deve clicar em solicitar amortização.
                            </p>		
                            <hr>							
                            <p><strong>Ao clicar no botão de solicitação você deve prosseguir preenchendo os campos solicitados.</strong></p>
                            Os campos solicitados são Contrato CAIXA, Contrato BNDES, Nome do Tomador, Conta para débito e valor de amortização.
                            Ficou mais facil né!
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h6 class="panel-title panel-trigger">
                            <a data-toggle="collapse" href="#question3">3. Como era solicitada uma amortização BNDES e como é agora?</a>
                        </h6>
                    </div>
                    <div id="question3" class="panel-collapse collapse">
                        <div class="panel-body">
                            <p class="alert alert-success fade in text-center">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                Antes a amortização era tratada pela GEMCO e agora é pela CEOPC!
                            </p>		
                            <hr>							
                            <p><strong>...mas efetivamente o que mudou?</strong></p>
                            Agora o processo cadastrado terá mais transparência pois poderá ser acompanhado pelo SIAF neste módulo.<br>
                            Além disso suprimir rotinas de e-mail darão celeridade ao processo...
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h6 class="panel-title panel-trigger">
                            <a data-toggle="collapse" href="#question4">4. Como acompanho a minha solicitação?</a>
                        </h6>
                    </div>
                    <div id="question4" class="panel-collapse collapse">
                        <div class="panel-body">
                            <p class="alert alert-success fade in text-center">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                Essa é facil.
                            </p>		
                            <hr>							
                            <p><strong>Ali em cima , clique no visualizar, ali no botão azul!</strong></p>
                            Você pode visualizar o histórico do pedido, data da entrada , data das verificações de saldo e da conclusão do processo.
                        </div>
                    </div>
                </div>
                    <div class="panel panel-default">
                    <div class="panel-heading">
                        <h6 class="panel-title panel-trigger">
                            <a data-toggle="collapse" href="#question5">5. O que significa cada STATUS?</a>
                        </h6>
                    </div>
                    <div id="question5" class="panel-collapse collapse">
                        <div class="panel-body">
                            <p class="alert alert-success fade in text-center">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                É simples, veja a legenda abaixo.
                            </p>		
                            <hr>							
                            <p><strong>CADASTRADO - </strong>  Demanda cadastrada pela AG SR OU GIGAD.</p>
                            <p><strong>EXCLUIDA UD - </strong>  Demanda excluida pela Unidade Demandante.</p>
                            <p><strong>CANCELADO - </strong>  Demanda cancelada pela CEOPC.</p>
                            <p><strong>RECEBIDO - </strong>  Demanda em processamaneto aguardando dia de débito (dia 15).</p>
                            <p><strong>FALTA SIBAN - </strong>  Demanda com pendência no SIBAN.</p>
                            <p><strong>SIBAN OK  - </strong>  Demanda analisada no siban, pronto para verificação automática de saldo.</p>
                            <p><strong>NA SUMEP - </strong>  Demanda enviada À SUMEP para tratamento .</p>
                            <p><strong>INCONFORME - </strong>  Demanda com impossibilidade de continuidade (FALTA SIBAN OU SEM SALDO).</p>
                            <p><strong>EM CALCULO - </strong>  Efetuando cálculos.</p>
                            <p><strong>ACATADO - </strong>  Demanda acatada no BNDES.</p>
                            <p><strong>CONCLUIDO - </strong>  Demanda de amortização\liquidação conferida e concluída.</p>
                            
                            
                        </div>
                    </div>
                </div>

                
            </div>
            <!-- Questions -->


        </div>
        <!--DUVIDAS FREQUENTES-->
        
        
                            <div class="col-md-6">
                            <div class="thumbnail thumbnail-boxed">
                                <div class="thumb">
                                    <img alt="" src="images/decop.jpg">
                                    <div class="thumb-options">
                                        <span>
                                            <a href="#" onclick=" window.open('http://www.ceopc.sp.caixa/novosiaf/padrao/geopc/sumep/ceopc/modulosiaf.php')" class="btn tip" title="Clique aqui e navegue pela video apresentação de slides!"><img alt="" src="images/decop6.png"></a>
                                            
                                        </span>
                                    </div>
                                </div>
                                <div class="caption">
                                    <a href="#" onclick=" window.open('http://www.ceopc.sp.caixa/novosiaf/padrao/geopc/sumep/ceopc/modulosiaf.php')"title="" class="caption-title">Novo Módulo SIAF Amortização - Apresentação </a>
                                    Clique no logo apresentado sobre a imagem para ser direcionado à video apresentação de divulgação deste módulo, navegue pelos slides, no menu a esquerda você encontra alguns esclarecimentos adicionais.
                                </div>
                            </div>
                            </div>
                            
                            
        
        
        
        
        
        
        
        </div>
           
        
        
        
        
               
        
    </div>
    
    <!-- /breadcrumbs line -->


    <!-- Info blocks -->
    
    <!-- /info blocks -->

    <!-- Alert -->
    
    <!-- /alert -->


    <!-- Questions and contact -->
    
    <!-- /questions and contact -->


    <!-- Newest team members -->
    
    <!-- /newest team members -->


    <!-- Alert -->
    
    <!-- /alert -->


    <!-- Tasks table -->
    
    <!-- /tasks table -->


    <!-- Recent activity -->
    
    <!-- /recent activity -->


    <!-- Footer -->
    <div class="footer clearfix">
        <div class="pull-left">&copy; 2019. Equipe TI CEOPC </div>
    </div>
    <!-- /footer -->


</div>
<!-- /page content -->


</div>
<!-- /page container -->

</body>
</html>

        
        <script src="{{ asset('js/plugins/forms/wysihtml5/wysihtml5.min.js')}}"></script>
        <script src="{{ asset('js/plugins/forms/wysihtml5/toolbar.js')}}"></script>
        <script src="{{ asset('js/plugins/charts/sparkline.min.js')}}"></script>
        <script src="{{ asset('js/plugins/forms/uniform.min.js')}}"></script>
        <script src="{{ asset('js/plugins/forms/select2.min.js')}}"></script>
        <script src="{{ asset('js/plugins/forms/inputmask.js')}}"></script>
        <script src="{{ asset('js/plugins/forms/inputlimit.min.js')}}"></script>
        <script src="{{ asset('js/plugins/forms/listbox.js')}}"></script>
        <script src="{{ asset('js/plugins/forms/multiselect.js')}}"></script>
        <script src="{{ asset('js/plugins/forms/validate.min.js')}}"></script>
        <script src="{{ asset('js/plugins/forms/tags.min.js')}}"></script>
        <script src="{{ asset('js/plugins/forms/switch.min.js')}}"></script>
        <script src="{{ asset('js/plugins/forms/uploader/plupload.full.min.js')}}"></script>
        <script src="{{ asset('js/plugins/forms/uploader/plupload.queue.min.js')}}"></script>
        
        
        <script src="{{ asset('js/plugins/forms/jquery.maskMoney.min.js')}}"></script>
        <script src="{{ asset('js/plugins/interface/daterangepicker.js')}}"></script>
        <script src="{{ asset('js/plugins/interface/fancybox.min.js')}}"></script>
        <script src="{{ asset('js/plugins/interface/moment.js')}}"></script>
        <script src="{{ asset('js/plugins/interface/jgrowl.min.js')}}"></script>
        <script src="{{ asset('js/plugins/interface/datatables.min.js')}}"></script>
        <script src="{{ asset('js/plugins/interface/colorpicker.js')}}"></script>
        <script src="{{ asset('js/plugins/interface/fullcalendar.min.js')}}"></script>
        <script src="{{ asset('js/plugins/interface/timepicker.min.js')}}"></script>
      
        <script src="{{ asset('js/plugins/forms/autosize.js')}}"></script>
        <script src="{{ asset('js/bootstrap.min.js')}}"></script>
        <script src="{{ asset('js/application.js')}}"></script>
        <!-- <script src="{{ asset('js/carrega_dados_dos_contratos.js')}}"></script> -->
        <script src="{{ asset('js/dados-base.js')}}"></script>
        <!-- <script src="{{ asset('js/index.js')}}"></script> -->
        <!-- <script src="{{ asset('js/incluirDataTableLotes.js')}}"></script> -->

</body>

</html>
