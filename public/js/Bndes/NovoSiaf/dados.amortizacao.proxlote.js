$(document).ready(function(){
   
    carregarTabelaProxLote();
//formata campo valor no modal de editar cadastro
$("input.dinheiro").maskMoney({showSymbol:true, symbol:"R$", decimal:",", thousands:"."});
 });	

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
    }
});

// carrega tabela com os contratos a serem amortizados no proximo lote

function carregarTabelaProxLote()
{
    $.getJSON('../api/bndes/v1/siaf_amortizacoes_lote_atual', function(json){

        $.each(json, function (key, value){
          
            linhaProxLote = atualizaTabelaProxLote(value);
            $('#tabelaAmortizaProx>tbody').append(linhaProxLote);
            
        }
        
        );
       
        $('#tabelaAmortizaProx').DataTable({
            responsive: true
        } );
       
  
    });
    
}

//atualiza a tabela para visualizacao dos contrato para o prox lote
function atualizaTabelaProxLote(json)
{
   
    // $('#tabelaAmortizaProx').DataTable();
    bDestroy : true,
	
	linhaProxLote = '<tr>' +
				
                
                '<td>' + json.codigoDemanda        + '</td>' +
                '<td>' + json.nomeCliente      + '</td>' +
                '<td>' + json.contratoCaixa    + '</td>' +
                '<td>' + json.contratoBndes    + '</td>' +
                '<td>' + json.contaDebito    + '</td>' +
                '<td>' + json.valorOperacao.replace(".", ",").replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.") + '</td>' +
                '<td>' + json.tipoOperacao.replace("A","AMORTIZAÇÃO").replace("L","LIQUIDAÇÃO")   + '</td>' +
                '<td>' + json.status	        + '</td>' +

				'<td>'	+				
					'<button class="btn btn-info btn-xs tip visualiza fa fa-binoculars center-block" id="botaoCadastrarProx" onclick ="visualizaContratoProxlote(\'' + json.codigoDemanda + '\')" ></button> ' + 
                '</td>' +
                '<td>'	+				
					'<button class="btn btn-warning btn-xs tip edita fa fa-edit center-block" id="botaoEditarProx" onclick ="editarContratoProx(\'' + json.codigoDemanda	+ '\')" ></button> ' + 
				'</td>' +
                
            '</tr>';
            // $(".dinheiro").maskMoney({showSymbol:true, symbol:"R$", decimal:",", thousands:"."});
     

            
    return linhaProxLote;
  
   
}
//carrega as informações do contrato para visualização
function visualizaContratoProxlote(json){

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
                
            $('#nome_cliente_modal').html(dados.nomeCliente);
            $('#cnpj_cliente_modal').html(dados.cnpj.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, "$1.$2.$3/$4-$5"));
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
//carrega as informações do contrato para edição
  function editarContratoProx(json){

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
        $('#nome_cliente_editar').html(dados.nomeCliente);
        $('#cnpj_cliente_editar').html(dados.cnpj.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, "$1.$2.$3/$4-$5"));
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
   

//pega as informações alteradas no modal e envia via post quando clicado no botão enviar a ceopc
// function enviarSolicitação(){

//     $.getJSON('../api/bndes/v1/siaf_amortizacoes_lote_atual', function(json){


//     var url = ('../api/bndes/v2/siaf_amortizacoes/' + json.codigoDemanda )

//     console.log(url);
    
    // $.ajax({
        
    //     type: 'post',
    //     url : url,
        
    //         success: function(editaContratoProx){
           
              
    //         var ctr = JSON.parse(editaContratoProx);
            
    //       //   $.each(ctr, function(key, ctr){
  
    //           $("#cnpj_cliente_editar").html(ctr.cnpj.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, "$1.$2.$3/$4-$5"));
    //           $("#nome_cliente_editar").html(ctr.nomeCliente);
  
    //           $("#contrato_bndes_editar").val(ctr.contratoBndes);
    //           $("#contrato_caixa_editar").val(ctr.contratoCaixa);
    //           $("#conta_corrente_editar").val(ctr.contaDebito);
    //           $("#valor_editar").val(ctr.valorOperacao.replace('.', ',').replace(/(\d)(?=(\d{3})+\,)/g, "$1."));
    //           $("#tipo_editar").val(ctr.tipoOperacao);
    //           $("#form_status_editar").val(ctr.status);  
    //           $("#pv_editar").val(ctr.codigoPa);  
    //           $("#sr_editar").val(ctr.codigoSr);
    //           $("#gigad_editar").val(ctr.codigoGigad);
    //           // $("#obs_editarAnt").val(ctr.CO_OBS);
                             
             
  
    //       //   });
         
    //     }
      
    // });  

//     }); 
// }
function enviarSolicitação(){


ctrProx = {
        // codigoDemanda : $("#codDemanda").val(),
        contratoBndes : $("#contrato_bndes_editar").val(), 
        // contratoCaixa : $("#contrato_caixa_editar").val(), 
        contaDebito : $("#conta_corrente_editar").val(), 
        valorOperacao : $("#valor_editar").val().replace(".","").replace(",","."), 
        tipoOperacao : $("#tipo_editar").val(), 
        status : $("#status_editar").val(),   
        // codigoPa : $("#pv_editar").val(),  
        // codigoSr: $("#sr_editar").val(),
        // codigoGigad : $("#gigad_editar").val(),
        observacoes : $("#observacaoContrato").val(),

}
$.ajax({

    type: 'PUT',
    url : '../api/bndes/v2/siaf_amortizacoes/' + $("#codDemanda").val() ,
    context : this,
    data: ctrProx,
    sucess: function(data){

        // $("#tabelaAmortizaProx").load(this);
        // atualizaTabelaProxLote();

//         xmlHttp=new XMLHttpRequest();
//         $('#tabelaAmortizaProx>tbody>tr').innerHTML=xmlHttp.responseText;
//         xmlHttp.open("GET","../api/bndes/v1/siaf_amortizacoes_lote_atual",true);
// //         $('#tabelaAmortizaProx>tbody>tr').load(data);
//         contrato = JSON.parse(ctrProx);
//         linha = $('#tabelaAmortizaProx>tbody>tr');
//         registroTabela = linha.filter(function(i, element){
//             return (element.cell[0].textContent==$("#codDemanda").val())
//         })
//         if (registroTabela) {
//             registroTabela[0].cells[0].textContent = $("#codDemanda").val();
//             registroTabela[0].cells[1].textContent = $("#contrato_caixa_editar").val();
//             registroTabela[0].cells[2].textContent = $("#contrato_bndes_editar").val();
//             registroTabela[0].cells[3].textContent = $("#conta_corrente_editar").val();
//             registroTabela[0].cells[4].textContent = $("#valor_editar").val();
//             registroTabela[0].cells[5].textContent = $("#tipo_editar").val();
//             registroTabela[0].cells[6].textContent = $("#status_editar").val();
// }
    }
 
});
// console.log(registroTabela);
console.log(ctrProx);

// $('#modalConfirmaAlteracao').modal('show');
}


  