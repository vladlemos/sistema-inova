
<!DOCTYPE html>
    <html lang="pt">
<head>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"> 
    <link href="{{ asset('css/template.css') }}" rel="stylesheet" type="text/css">  

    <script src="{{ asset('js/plugins/jquery/jquery-1.12.1.min.js')}}"></script>
    <script src="{{ asset('js/plugins/jquery/jquery-ui.min.js')}}"></script>
</head>

<body>

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
                            <li><a href="#tab222" data-toggle="tabInstrucoes"><i class="icon-book"></i>Instruções </a></li>
                            
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="tabSelecionar">
                            <div class="row"><small class="display-block "><strong> RATIFICAR AS INFORMAÇÕES CARREGADAS! No caso de dúvidas consulte as instruções de preenchimento no menu acima ! &nbsp &nbsp &nbsp </small></div></strong>
                            
                            <div class="row"><small class="display-block text-danger active"> Para solicitar, Informe abaixo o nº BNDES, valor, confirme a conta, contrato e o tipo de comando dos contratos desejados e envie à CEOPC!  </small></div>
                            
                            <h5 class=""><span id="nome_cliente2"></span>  <span id="cnpj_cliente2"></span></h5>
                            
                                
                                <form class="form-group has-feedback" action="" method="post" role="form" id="formulario_pedido_amortizacao">
                            
                            
                                <input type="hidden" id="nome_cliente3"  name="nome_cliente3">
                                <input type="hidden" id="cnpj_cliente3" name="cnpj_cliente3">
                                
                                <div class="form-group">
                            
                                <table class="table table-bordered table-striped datatable">
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
                            <textarea class="editor form-control" rows="3"name="co_observacoes" placeholder="Digite as observações da solicitação aqui...."></textarea>  
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

    <script src="{{ asset('js/bootstrap.min.js')}}"></script>
     <script src="{{ asset('js/application.js')}}"></script>
     <script src="{{ asset('js/dados-base.js')}}"></script>

</body>

</html>
