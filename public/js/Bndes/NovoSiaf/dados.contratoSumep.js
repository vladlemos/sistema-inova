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
       
        $('#tabelaSumep').DataTable();
           
           
            
            
    });
    
}

function atualizaTabelaSumep(json)
{
    // $('#tabelaSumep').DataTable();
    bDestroy : true,
	
	linhaSumep = '<tr>' +
				
                
                '<td>' + json.codigoDemanda     + '</td>' +
                '<td>' + json.nomeCliente       + '</td>' +
                '<td>' + json.contratoCaixa     + '</td>' +
                '<td>' + json.contratoBndes     + '</td>' +
                '<td>' + json.dataLote          + '</td>' +
                '<td>' + json.valorOperacao.replace(".", ",") + '</td>' +
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

    var url = ('../api/bndes/v1/siaf_amortizacoes/' + json )
    
  $.ajax({
      
      type: 'GET',
      url : url,
      
          success: function(carregaContratoSumep){
         
            
          var ctrSumep = JSON.parse(carregaContratoSumep);
          
          $.each(ctrSumep, function(key, value){

            $("#cnpj_cliente_modal").html(value.cnpj.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, "$1.$2.$3/$4-$5"));
            $("#nome_cliente_modal").html(value.nomeCliente);
                           
            $("#contrato_bndes_modal").val(value.contratoBndes);
            $("#contrato_caixa_modal").val(value.contratoCaixa);
            $("#conta_corrente_modal").val(value.contaDebito);
            $("#valor_modal").val(value.valorOperacao.replace('.',','));
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

function editarContratoSumep(json){

var url = ('../api/bndes/v1/siaf_amortizacoes/' + json )

$.ajax({
  
  type: 'GET',
  url : url,
  
      success: function(editaContratoSumep){
     
        
      var ctrSumep = JSON.parse(editaContratoSumep);
      
      $.each(ctrSumep, function(key, value){

          $("#cnpj_cliente_editar").html(value.cnpj.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, "$1.$2.$3/$4-$5"));
          $("#nome_cliente_editar").html(value.nomeCliente);

        $("#contrato_bndes_editar").val(value.contratoBndes);
        $("#contrato_caixa_editar").val(value.contratoCaixa);
        $("#conta_corrente_editar").val(value.contaDebito);
        $("#valor_editar").val(value.valorOperacao.replace('.',','));
        $("#tipo_editar").val(value.tipoOperacao);
        $("#status_editar").val(value.status);  
        $("#pv_editar").val(value.codigoPa);  
        $("#sr_editar").val(value.codigoSr);
        $("#gigad_editar").val(value.codigoGigad);
        // $("#obs_editarAnt").val(value.CO_OBS);
                       
       

      });
   
  }

});  


$('#editarcontrato').modal('show');

}   

