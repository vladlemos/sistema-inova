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
       
        $('#tabelaAmortizaProx').DataTable();
       
  
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
                '<td class="dinheiro">' + json.valorOperacao     + '</td>' +
                '<td>' + json.tipoOperacao   + '</td>' +
                '<td>' + json.status	        + '</td>' +

				'<td>'	+				
					'<button class="btn btn-info btn-xs tip visualiza fa fa-binoculars center-block" id="botaoCadastrarProx" onclick ="visualizaContratoProxlote(\'' + json.codigoDemanda + '\')" ></button> ' + 
                '</td>' +
                '<td>'	+				
					'<button class="btn btn-warning btn-xs tip edita fa fa-edit center-block" id="botaoEditarProx" onclick ="editarContratoProx(\'' + json.codigoDemanda	+ '\')" ></button> ' + 
				'</td>' +
                
            '</tr>';
            $(".dinheiro").maskMoney({showSymbol:true, symbol:"R$", decimal:",", thousands:"."});
     

            
    return linhaProxLote;
  
   
}
//carrega as informações do contrato para visualização
function visualizaContratoProxlote(json){

        var url = ('../api/bndes/v1/siaf_amortizacoes/' + json )
        
      $.ajax({
          
          type: 'GET',
          url : url,
          
              success: function(carregaContratoProx){
             
                
              var ctr = JSON.parse(carregaContratoProx);
              
              $.each(ctr, function(key, value){
  
                $("#cnpj_cliente_modal").html(value.cnpj.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, "$1.$2.$3/$4-$5"));
                $("#nome_cliente_modal").html(value.nomeCliente);
                               
                $("#contrato_bndes_modal").val(value.contratoBndes);
                $("#contrato_caixa_modal").val(value.contratoCaixa);
                $("#conta_corrente_modal").val(value.contaDebito);
                $("#valor_modal").val(value.valorOperacao);
                $("#tipo_modal").val(value.tipoOperacao);
                $("#status_modal").val(value.status);  
                $("#pv_modal").val(value.codigoPa);  
                $("#sr_modal").val(value.codigoSr);
                $("#gigad_modal").val(value.codigoGigad);
                // $("#obs_modalAnterior").val(value.CO_OBS);

              });
           
          }
        
      });  
  
      
      $('#visualizarcontrato').modal('show');
     
  }   
//carrega as informações do contrato para edição
  function editarContratoProx(json){

    var url = ('../api/bndes/v1/siaf_amortizacoes/' + json )
    
  $.ajax({
      
      type: 'GET',
      url : url,
      
          success: function(editaContratoProx){
         
            
          var ctr = JSON.parse(editaContratoProx);
          
          $.each(ctr, function(key, value){

              $("#cnpj_cliente_editar").html(value.cnpj.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, "$1.$2.$3/$4-$5"));
              $("#nome_cliente_editar").html(value.nomeCliente);

            $("#contrato_bndes_editar").val(value.contratoBndes);
            $("#contrato_caixa_editar").val(value.contratoCaixa);
            $("#conta_corrente_editar").val(value.contaDebito);
            $("#valor_editar").val(value.valorOperacao);
            $("#tipo_editar").val(value.tipoOperacao);
            $("#form_status_editar").val(value.status);  
            $("#pv_editar").val(value.codigoPa);  
            $("#sr_editar").val(value.codigoSr);
            $("#gigad_editar").val(value.codigoGigad);
            // $("#obs_editarAnt").val(value.CO_OBS);
                           
           

          });
       
      }
    
  });  

  
  $('#editarcontrato').modal('show');
 
}   
   

  