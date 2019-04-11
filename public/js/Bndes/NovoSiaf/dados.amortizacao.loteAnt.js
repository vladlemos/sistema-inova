$(document).ready(function(){
   
    carregarTabelaLoteAnt();
   
 });	

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
    }
});

// carrega tabela dos clientes da agência de acordo com o Perfil 

function carregarTabelaLoteAnt()
{
    $.getJSON('../api/siaf_amortizacoes_lote_anterior', function(json){

        $.each(json, function (key, value){
            $('#loteAnt').html(value.DT_LT_AMORTIZADOR);
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
            
    return linhaLoteAnt;
   
}
