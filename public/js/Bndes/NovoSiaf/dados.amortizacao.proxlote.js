$(document).ready(function(){
   
    carregarTabelaProxLote();
   
 });	

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
    }
});

// carrega tabela dos clientes da agência de acordo com o Perfil 

function carregarTabelaProxLote()
{
    $.getJSON('../api/siaf_amortizacoes_lote_atual', function(json){

        $.each(json, function (key, value){
            $('#proxLote').html(value.DT_LT_AMORTIZADOR);
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
				
                
                '<td>' + json.CO_PEDIDO	        + '</td>' +
                '<td>' + json.NO_CLIENTE        + '</td>' +
                '<td>' + json.CONTRATO_CAIXA    + '</td>' +
                '<td>' + json.CONTRATO_BNDES    + '</td>' +
                '<td>' + json.CONTA_CORRENTE    + '</td>' +
                '<td>' + json.VL_AMORTIZADO     + '</td>' +
                '<td>' + json.TP_AMORTIZACAO    + '</td>' +
                '<td>' + json.STATUS	        + '</td>' +

				'<td>'	+				
					'<button class="btn btn-info btn-xs tip visualiza icon-pencil3 center-block" id="botaoCadastrar" onclick ="visualizaContrato(\'' + json.CO_PEDIDO + '\')" ></button> ' + 
                '</td>' +
                '<td>'	+				
					'<button class="btn btn-warning btn-xs tip edita fa fa-edit center-block" id="botaoEditar" onclick ="visualizaContrato(\'' + json.CO_PEDIDO + '\')" ></button> ' + 
				'</td>' +
                
            '</tr>';

     

            
    return linhaProxLote;
  
   
}
