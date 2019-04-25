$(document).ready(function(){
   
    carregarTabelaSumep();
   
 });	

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
    }
});

// //carrega tabela com os contratos pendentes na SUMEP

function carregarTabelaSumep()
{
    $.getJSON('../api/bndes/v1/siaf_contratos_sumep', function(json){

        $.each(json, function (key, value){
          
            linhaSumep = atualizaTabelaSumep(value);
            $('#tabelaSumep>tbody').append(linhaSumep);

        }
        
        );
       
        $('#tabelaSumep').DataTable({
            responsive: true,
        } );
   
            
            
    });
    
}

function atualizaTabelaSumep(json)
{
   
    bDestroy : true,
	
	linhaSumep = '<tr>' +
				
                
                '<td>' + json.codigoDemanda     + '</td>' +
                '<td>' + json.nomeCliente       + '</td>' +
                '<td>' + json.contratoCaixa     + '</td>' +
                '<td>' + json.contratoBndes     + '</td>' +
                '<td>' + json.dataLote          + '</td>' +
                '<td>' + json.valorOperacao     + '</td>' +
                '<td>' + json.tipoOperacao    + '</td>' +
                '<td>' + json.status	        + '</td>' +

				'<td>'	+				
					'<button class="btn btn-info btn-xs tip visualiza fa fa-binoculars center-block" id="botaoCadastrarSumep" onclick ="visualizaContratoSumep(\'' + json.codigoDemanda + '\')" ></button> ' + 
                '</td>' +
                '<td>'	+				
					'<button class="btn btn-warning btn-xs tip edita fa fa-edit center-block" id="botaoEditarSumep" onclick ="editarContratoSumep(\'' + json.codigoDemanda + '\')" ></button> ' + 
				'</td>' +
                
            '</tr>';
            
    return linhaSumep;
   
}

function visualizaContratoSumep(json){

           
            $.get( '../api/bndes/v2/siaf_amortizacoes/' + json, function(dados) {

                var dados = JSON.parse(dados);
                console.log(dados);
                for(i = 0; i < dados.consultaSaldo.length; i++){
                    linha = montaLinhaTabelaSaldo(dados.consultaSaldo[i]);
                               
                    $('#tabHistoricoSaldo>tbody').append(linha);
                }              
                function montaLinhaTabelaSaldo(dadosSaldo)
                {
                    bDestroy= true;

                    linha = '<tr>' +
                                '<td>' + dadosSaldo.codigoConsultaSaldo + '</td>' +
                                '<td>' + dadosSaldo.dataConsultaSaldo + '</td>' +
                                '<td>' + dadosSaldo.statusSaldo + '</td>' +
                                '<td>' + dadosSaldo.saldoDisponivel + '</td>' +
                                '<td>' + dadosSaldo.saldoBloqueado + '</td>' +
                                '<td>' + dadosSaldo.LimiteChequeAzul + '</td>' +
                                '<td>' + dadosSaldo.LimiteGim + '</td>' +
                                '<td>' + dadosSaldo.saldoTotal + '</td>' +
                            '</tr>';
                    return linha;

            
                }
                
                for(i = 0; i < dados.historicoContrato.length; i++){
                    linha = montaLinhaTabelaHistorico(dados.historicoContrato[i]);
                    
                    $('#tabHistoricoContrato>tbody').append(linha);
                }              
                function montaLinhaTabelaHistorico(dadosHistorico)
                {
                    bDestroy= true;
                    linha = '<tr>' +
                                '<td>' + dadosHistorico.codigoHistorico + '</td>' +
                                '<td>' + dadosHistorico.dataHistorico + '</td>' +
                                '<td>' + dadosHistorico.statusHistorico + '</td>' +
                                '<td>' + dadosHistorico.observacaoHistorico + '</td>' +
                                '<td>' + dadosHistorico.matriculaResponsavel + '</td>' +
                                '<td>' + dadosHistorico.unidadeResponsavel + '</td>' +
                            
                            '</tr>';
                    return linha;
                
                }
                
                $('#nome_cliente_modal').val(dados.nomeCliente);
                $('#cnpj_cliente_modal').val(dados.cnpj.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, "$1.$2.$3/$4-$5"));
                $('#status_modal').val(dados.status);
                $('#contrato_caixa_modal').val(dados.contratoCaixa);
                $('#contrato_bndes_modal').val(dados.contratoBndes);
                $('#conta_corrente_modal').val(dados.contaDebito);
                $('#tipo_modal').val(dados.tipoOperacao);
                $('#valor_modal').val(dados.valorOperacao);
                $('#pv_modal').val(dados.codigoPa);
                $('#sr_modal').val(dados.codigoSr);
                $('#gigad_modal').val(dados.codigoGigad);

        
            jQuery('#visualizarcontrato').on('hidden.bs.modal', function (e) {
            jQuery(this).removeData('#tabHistoricoSaldo>tbody');
            jQuery(this).find('#tabHistoricoSaldo>tbody').empty();
            jQuery(this).removeData('#tabHistoricoContrato>tbody');
            jQuery(this).find('#tabHistoricoContrato>tbody').empty();
            })
        });  

            $('#visualizarcontrato').modal('show');
}


function editarContratoSumep(json){

    $.get( '../api/bndes/v2/siaf_amortizacoes/' + json, function(dados) {

        var dados = JSON.parse(dados);
        console.log(dados);
        for(i = 0; i < dados.consultaSaldo.length; i++){
            linha = montaLinhaTabelaSaldo(dados.consultaSaldo[i]);
            
       
            $('#tabConsultaSaldoEditar>tbody').append(linha);
        }              
        function montaLinhaTabelaSaldo(dadosSaldo)
        {
            bDestroy= true;

            linha = '<tr>' +
                        '<td>' + dadosSaldo.codigoConsultaSaldo + '</td>' +
                        '<td>' + dadosSaldo.dataConsultaSaldo + '</td>' +
                        '<td>' + dadosSaldo.statusSaldo + '</td>' +
                        '<td>' + dadosSaldo.saldoDisponivel + '</td>' +
                        '<td>' + dadosSaldo.saldoBloqueado + '</td>' +
                        '<td>' + dadosSaldo.LimiteChequeAzul + '</td>' +
                        '<td>' + dadosSaldo.LimiteGim + '</td>' +
                        '<td>' + dadosSaldo.saldoTotal + '</td>' +
                    '</tr>';
            return linha;

       
        }
         
        for(i = 0; i < dados.historicoContrato.length; i++){
            linha = montaLinhaTabelaHistorico(dados.historicoContrato[i]);
            
            $('#tabConsultaHistoricoEditar>tbody').append(linha);
        }              
        function montaLinhaTabelaHistorico(dadosHistorico)
        {
            bDestroy= true;
            linha = '<tr>' +
                        '<td>' + dadosHistorico.codigoHistorico + '</td>' +
                        '<td>' + dadosHistorico.dataHistorico + '</td>' +
                        '<td>' + dadosHistorico.statusHistorico + '</td>' +
                        '<td>' + dadosHistorico.observacaoHistorico + '</td>' +
                        '<td>' + dadosHistorico.matriculaResponsavel + '</td>' +
                        '<td>' + dadosHistorico.unidadeResponsavel + '</td>' +
                       
                    '</tr>';
            return linha;
         
        }
          

        $('#codDemanda').val(dados.codigoDemanda);
        $('#nome_cliente_editar').val(dados.nomeCliente);
        $('#cnpj_cliente_editar').val(dados.cnpj.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, "$1.$2.$3/$4-$5"));
        $('#status_editar').val(dados.status);
        $('#contrato_caixa_editar').val(dados.contratoCaixa);
        $('#contrato_bndes_editar').val(dados.contratoBndes);
        $('#conta_corrente_editar').val(dados.contaDebito);
        $('#tipo_editar').val(dados.tipoOperacao);
        $('#valor_editar').val(dados.valorOperacao);
        $('#pv_editar').val(dados.codigoPa);
        $('#sr_editar').val(dados.codigoSr);
        $('#gigad_editar').val(dados.codigoGigad);


            jQuery('#editarcontrato').on('hidden.bs.modal', function (e) {
            jQuery(this).removeData('#tabConsultaSaldoEditar>tbody');
            jQuery(this).find('#tabConsultaSaldoEditar>tbody').empty();
            jQuery(this).removeData('#tabConsultaHistoricoEditar>tbody');
            jQuery(this).find('#tabConsultaHistoricoEditar>tbody').empty();
            })
        });  



$('#editarcontrato').modal('show');

}   

function enviarSolicitação(){

    // var url = ('../api/bndes/v2/siaf_amortizacoes/' + json )

// $.ajax({
  
//   type: 'POST',
//   //   url : url,
//   datatype: 'json',

//   success: function(enviarDadosContratoAnt){
     

ctrSumep = {
        codigoDemanda : $("#codDemanda").val(),
        contratoBndes : $("#contrato_bndes_editar").val(), 
        // contratoCaixa : $("#contrato_caixa_editar").val(), 
        contaDebito : $("#conta_corrente_editar").val(), 
        valorOperacao : $("#valor_editar").val().replace(".","").replace(",","."), 
        tipoOperacao : $("#tipo_editar").val(), 
        status : $("#status_editar").val(),   
        // codigoPa : $("#pv_editar").val(),  
        // codigoSr: $("#sr_editar").val(),
        // codigoGigad : $("#gigad_editar").val(),
        historicoContrato : $("#observacaoContrato").val(),

}

$.ajax({

    type: 'PUT',
    url : '../api/bndes/v2/siaf_amortizacoes/' + $("#codDemanda").val() ,
    context : this,
    data: ctrSumep,
    sucess: function(ctrSumep){
        contrato = JSON.parse(ctrSumep);
        linha = $('#tabConsultaHistoricoEditar>tbody>tr');
        registroTabela = linha.filter(function(i, element){
            return (element.cell[0].textContent==$("#codDemanda").val())
        })
    }
//  console.log(contrato.json);
});

console.log(ctrSumep);

// $('#modalConfirmaAlteracao').modal('show');
}