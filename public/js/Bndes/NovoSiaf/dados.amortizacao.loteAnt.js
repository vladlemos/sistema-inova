$(document).ready(function(){
   
    carregarTabelaLoteAnt();
    
 });	

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
    }
});

//carrega tabela com os contratos amortizados no lote anterior

function carregarTabelaLoteAnt()
{
    $.getJSON('../api/bndes/v1/siaf_amortizacoes_lote_anterior', function(json){

        $.each(json, function (key, value){
            // $('#loteAnt').html(value.DT_LT_AMORTIZADOR);
            linhaLoteAnt = atualizaTabelaLoteAnt(value);
            $('#tabelaLoteAnterior>tbody').append(linhaLoteAnt);

        }
        
        );
       
        $('#tabelaLoteAnterior').DataTable();
   
    });
    
}

function atualizaTabelaLoteAnt(json)
{
    // $('#tabelaLoteAnterior').DataTable();
    bDestroy : true,
	
	linhaLoteAnt = '<tr>' +
				
                
                '<td>' + json.codigoDemanda        + '</td>' +
                '<td>' + json.nomeCliente       + '</td>' +
                '<td>' + json.contratoCaixa    + '</td>' +
                '<td>' + json.contratoBndes    + '</td>' +
                '<td>' + json.contaDebito    + '</td>' +
                '<td>' + json.valorOperacao    + '</td>' +
                '<td>' + json.tipoOperacao   + '</td>' +
                '<td>' + json.status	        + '</td>' +

				'<td>'	+				
					'<button class="btn btn-info btn-xs tip visualiza fa fa-binoculars center-block" id="botaoCadastrarAnt" onclick ="visualizaContratoAnt(\'' + json.codigoDemanda + '\')" ></button> ' + 
                '</td>' +
                '<td>'	+				
					'<button class="btn btn-warning btn-xs tip edita fa fa-edit center-block" id="botaoEditarAnt" onclick ="editarContratoAnt(\'' + json.codigoDemanda + '\')" ></button> ' + 
				'</td>' +
                
            '</tr>';
            
           
            // $(".dinheiro").maskMoney({showSymbol:true, symbol:"R$", decimal:",", thousands:"."});
    return linhaLoteAnt;
   
}

//carrega as informações do contrato para visualização
function visualizaContratoAnt(json){
    
  
    // var url = ('../api/bndes/v2/siaf_amortizacoes/' + json )
    
//   $.ajax({
      
//       type: 'GET',
//       url : url,
      
//           success:
//            function carregaContrato(){
         
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
                        // jQuery('visualizarcontrato').on('hidden.bs.modal', function (e) {
                        // jQuery(this).removeData('#tabHistorico>tbody');
                        // jQuery(this).find('#tabHistorico>tbody').empty();
                        // })
            
                    // $('#codigoDemanda').val(dados.codigoDemanda);
                    $('#nome_cliente_modal').val(dados.nomeCliente);
                    $('#cnpj_cliente_modal').val(dados.cnpj.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, "$1.$2.$3/$4-$5"));
                    $('#status_modal').val(dados.status);
                    $('#contrato_caixa_modal').val(dados.contratoCaixa);
                    $('#contrato_bndes_modal').val(dados.contratoBndes);
                    $('#conta_corrente_modal').val(dados.contaDebito);
                    $('#tipo_modal').val(dados.tipoOperacao);
                    $('#valor_modal').val(dados.valorOperacao);
                    $('#pv_modal').val(dados.codigoPa);
                    $('#codigoSr').val(dados.codigoSr);
                    $('#gigad_modal').val(dados.codigoGigad);

             
            // }
            
        //   var ctrAnt = JSON.parse(carregaContratoAnt);
        
        // //   $.each(ctrAnt, function(key, value){

        //     $("#cnpj_cliente_modal").html(ctrAnt.cnpj.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, "$1.$2.$3/$4-$5"));
        //     $("#nome_cliente_modal").html(ctrAnt.nomeCliente);
                           
        //     $("#contrato_bndes_modal").val(ctrAnt.contratoBndes);
        //     $("#contrato_caixa_modal").val(ctrAnt.contratoCaixa);
        //     $("#conta_corrente_modal").val(ctrAnt.contaDebito);
        //     $("#valor_modal").val(ctrAnt.valorOperacao);
        //     $("#tipo_modal").val(ctrAnt.tipoOperacao);
        //     $("#status_modal").val(ctrAnt.status);  
        //     $("#pv_modal").val(ctrAnt.codigoPa);  
        //     $("#sr_modal").val(ctrAnt.codigoSr);
        //     $("#gigad_modal").val(ctrAnt.codigoGigad);
            // $("#obs_modalAnterior").val(ctrAnt.CO_OBS);

        //   });
      
    //   }
    jQuery('#visualizarcontrato').on('hidden.bs.modal', function (e) {
        jQuery(this).removeData('#tabHistoricoSaldo>tbody');
        jQuery(this).find('#tabHistoricoSaldo>tbody').empty();
        jQuery(this).removeData('#tabHistoricoContrato>tbody');
        jQuery(this).find('#tabHistoricoContrato>tbody').empty();
        })
  });  

  
 
$('#visualizarcontrato').modal('show');
// });
}   

//carrega as informações do contrato para editar
function editarContratoAnt(json){
    //function carregaContrato(){
         
        $.get( '../api/bndes/v2/siaf_amortizacoes/' + json, function(dados) {

            var dados = JSON.parse(dados);
            console.log(dados);
            for(i = 0; i < dados.consultaSaldo.length; i++){
                linha = montaLinhaTabelaSaldo(dados.consultaSaldo[i]);
                
           
                $('#tabConsultaHistoricoEditar>tbody').append(linha);
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
                
                $('#tabHistoricoEditar>tbody').append(linha);
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
                // jQuery('visualizarcontrato').on('hidden.bs.modal', function (e) {
                // jQuery(this).removeData('#tabHistorico>tbody');
                // jQuery(this).find('#tabHistorico>tbody').empty();
                // })
    
            // $('#codigoDemanda').val(dados.codigoDemanda);
            $('#nome_cliente_modal').val(dados.nomeCliente);
            $('#cnpj_cliente_modal').val(dados.cnpj.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, "$1.$2.$3/$4-$5"));
            $('#status_modal').val(dados.status);
            $('#contrato_caixa_modal').val(dados.contratoCaixa);
            $('#contrato_bndes_modal').val(dados.contratoBndes);
            $('#conta_corrente_modal').val(dados.contaDebito);
            $('#tipo_modal').val(dados.tipoOperacao);
            $('#valor_modal').val(dados.valorOperacao);
            $('#pv_modal').val(dados.codigoPa);
            $('#codigoSr').val(dados.codigoSr);
            $('#gigad_modal').val(dados.codigoGigad);

     
    // }
    
//   var ctrAnt = JSON.parse(carregaContratoAnt);

// //   $.each(ctrAnt, function(key, value){

//     $("#cnpj_cliente_modal").html(ctrAnt.cnpj.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, "$1.$2.$3/$4-$5"));
//     $("#nome_cliente_modal").html(ctrAnt.nomeCliente);
                   
//     $("#contrato_bndes_modal").val(ctrAnt.contratoBndes);
//     $("#contrato_caixa_modal").val(ctrAnt.contratoCaixa);
//     $("#conta_corrente_modal").val(ctrAnt.contaDebito);
//     $("#valor_modal").val(ctrAnt.valorOperacao);
//     $("#tipo_modal").val(ctrAnt.tipoOperacao);
//     $("#status_modal").val(ctrAnt.status);  
//     $("#pv_modal").val(ctrAnt.codigoPa);  
//     $("#sr_modal").val(ctrAnt.codigoSr);
//     $("#gigad_modal").val(ctrAnt.codigoGigad);
    // $("#obs_modalAnterior").val(ctrAnt.CO_OBS);

//   });

//   }
            jQuery('#visualizarcontrato').on('hidden.bs.modal', function (e) {
            jQuery(this).removeData('#tabConsultaHistoricoEditar>tbody');
            jQuery(this).find('#tabConsultaHistoricoEditar>tbody').empty();
            jQuery(this).removeData('#tabHistoricoEditar>tbody');
            jQuery(this).find('#tabHistoricoEditar>tbody').empty();
            })
});  

// var url = ('../api/bndes/v2/siaf_amortizacoes/' + json )

// $.ajax({
  
//   type: 'GET',
//   url : url,
  
//       success: function(editarContratoAnt){
     
        
//       var ctrAnt = JSON.parse(editarContratoAnt);
      
//     //   $.each(ctr, function(key, ctrAnt){
//         $("#codDemanda").val(ctrAnt.codigoDemanda);

//           $("#cnpj_cliente_editar").html(ctrAnt.cnpj.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, "$1.$2.$3/$4-$5"));
//           $("#nome_cliente_editar").html(ctrAnt.nomeCliente);

//         $("#contrato_bndes_editar").val(ctrAnt.contratoBndes);
//         $("#contrato_caixa_editar").val(ctrAnt.contratoCaixa);
//         $("#conta_corrente_editar").val(ctrAnt.contaDebito);
//         $("#valor_editar").val(ctrAnt.valorOperacao);
//         $("#tipo_editar").val(ctrAnt.tipoOperacao);
//         $("#status_editar").val(ctrAnt.status);  
//         $("#pv_editar").val(ctrAnt.codigoPa);  
//         $("#sr_editar").val(ctrAnt.codigoSr);
//         $("#gigad_editar").val(ctrAnt.codigoGigad);
//         // $("#obs_editarAnt").val(ctrAnt.CO_OBS);
                       
       
        
//     //   });
   
//   }

// });  


$('#editarcontrato').modal('show');

}   


function enviarSolicitação(){

    // var url = ('../api/bndes/v2/siaf_amortizacoes/' + json )

// $.ajax({
  
//   type: 'POST',
//   //   url : url,
//   datatype: 'json',

//   success: function(enviarDadosContratoAnt){
     

ctrAnt = {
        codigoDemanda : $("#codDemanda").val(),
        contratoBndes : $("#contrato_bndes_editar").val(), 
        contratoCaixa : $("#contrato_caixa_editar").val(), 
        contaDebito : $("#conta_corrente_editar").val(), 
        valorOperacao : $("#valor_editar").val().replace(".","").replace(",","."), 
        tipoOperacao : $("#tipo_editar").val(), 
        status : $("#status_editar").val(),   
        codigoPa : $("#pv_editar").val(),  
        codigoSr: $("#sr_editar").val(),
        codigoGigad : $("#gigad_editar").val(),
        historicoContrato : $("#obs_editarAnt").val(),

}

// console.log(ctrAnt);

$('#modalConfirmaAlteracao').modal('show');
}