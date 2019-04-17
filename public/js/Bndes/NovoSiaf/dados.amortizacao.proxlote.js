$(document).ready(function(){
   
    carregarTabelaProxLote();
   
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
            // $('#proxLote').html(value.DT_LT_AMORTIZADOR);
            linhaProxLote = atualizaTabelaProxLote(value);
            $('#tabelaAmortizaProx>tbody').append(linhaProxLote);
            
        }
        
        );
       
        $('#tabelaAmortizaProx').DataTable({
            responsive: true
        } );
       
  
    });
    
}

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
                '<td>' + json.valorOperacao.replace('.', ',').replace(/(\d)(?=(\d{3})+\,)/g, "$1.")      + '</td>' +
                '<td>' + json.tipoOperacao   + '</td>' +
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

        var url = ('../api/bndes/v2/siaf_amortizacoes/' + json )
        
      $.ajax({
          
          type: 'GET',
          url : url,
          
              success: function(carregaContratoProx){
             
                
              var ctr = JSON.parse(carregaContratoProx);
              
            //   $.each(ctr, function(key, value){
  
                $("#cnpj_cliente_modal").html(ctr.cnpj.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, "$1.$2.$3/$4-$5"));
                $("#nome_cliente_modal").html(ctr.nomeCliente);
                               
                $("#contrato_bndes_modal").val(ctr.contratoBndes);
                $("#contrato_caixa_modal").val(ctr.contratoCaixa);
                $("#conta_corrente_modal").val(ctr.contaDebito);
                $("#valor_modal").val(ctr.valorOperacao.replace('.', ',').replace(/(\d)(?=(\d{3})+\,)/g, "$1.") );
                $("#tipo_modal").val(ctr.tipoOperacao);
                $("#status_modal").val(ctr.status);  
                $("#pv_modal").val(ctr.codigoPa);  
                $("#sr_modal").val(ctr.codigoSr);
                $("#gigad_modal").val(ctr.codigoGigad);
                // $("#obs_modalAnterior").val(ctr.CO_OBS);

            //   });
           
          }
        
      });  
  
      
      $('#visualizarcontrato').modal('show');
     
  }   
//carrega as informações do contrato para edição
  function editarContratoProx(json){

    var url = ('../api/bndes/v2/siaf_amortizacoes/' + json )
    
  $.ajax({
      
      type: 'GET',
      url : url,
      
          success: function(editaContratoProx){
         
            
          var ctr = JSON.parse(editaContratoProx);
          
        //   $.each(ctr, function(key, ctr){

            $("#cnpj_cliente_editar").html(ctr.cnpj.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, "$1.$2.$3/$4-$5"));
            $("#nome_cliente_editar").html(ctr.nomeCliente);

            $("#contrato_bndes_editar").val(ctr.contratoBndes);
            $("#contrato_caixa_editar").val(ctr.contratoCaixa);
            $("#conta_corrente_editar").val(ctr.contaDebito);
            $("#valor_editar").val(ctr.valorOperacao.replace('.', ',').replace(/(\d)(?=(\d{3})+\,)/g, "$1."));
            $("#tipo_editar").val(ctr.tipoOperacao);
            $("#form_status_editar").val(ctr.status);  
            $("#pv_editar").val(ctr.codigoPa);  
            $("#sr_editar").val(ctr.codigoSr);
            $("#gigad_editar").val(ctr.codigoGigad);
            // $("#obs_editarAnt").val(ctr.CO_OBS);
                           
           

        //   });
       
      }
    
  });  

  
  $('#editarcontrato').modal('show');
 
}   
   

  