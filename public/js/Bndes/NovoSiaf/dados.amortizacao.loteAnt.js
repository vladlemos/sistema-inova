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
					'<button class="btn btn-info btn-xs tip visualiza fa fa-binoculars center-block" id="botaoCadastrarAnt" onclick ="visualizaContratoAnt(\'' + json.CONTRATO_CAIXA + '\')" ></button> ' + 
                '</td>' +
                '<td>'	+				
					'<button class="btn btn-warning btn-xs tip edita fa fa-edit center-block" id="botaoEditarAnt" onclick ="editarContratoAnt(\'' + json.CONTRATO_CAIXA + '\')" ></button> ' + 
				'</td>' +
                
            '</tr>';
            
            $("input.dinheiro").maskMoney({showSymbol:true, symbol:"R$", decimal:",", thousands:"."});
    return linhaLoteAnt;
   
}

//carrega as informações do contrato para visualização
function visualizaContratoAnt(json){

    var url = ('../api/bndes/v1/siaf_contratos/' + json )
    
  $.ajax({
      
      type: 'GET',
      url : url,
      
          success: function(carregaContratoAnt){
         
            
          var ctrAnt = JSON.parse(carregaContratoAnt);
          
          $.each(ctrAnt, function(key, value){

            $("#cnpj_cliente_modal").html(value.CNPJ.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, "$1.$2.$3/$4-$5"));
            $("#nome_cliente_modal").html(value.CLIENTE);
                           
            $("#contrato_bndes_modal").val(value.CONTRATO_BNDES);
            $("#contrato_caixa_modal").val(value.CONTRATO_CAIXA);
            $("#conta_corrente_modal").val(value.CONTA_CORRENTE);
            $("#valor_modal").val(value.VL_AMORTIZADO);
            $("#tipo_modal").val(value.TP_AMORTIZACAO);
            $("#status_editar").option(value.STATUS);  
            $("#pv_modal").val(value.COD_PA);  
            $("#sr_modal").val(value.COD_SR);
            $("#gigad_modal").val(value.COD_GIGAD);
            $("#obs_modalAnterior").val(value.CO_OBS);

          });
       
      }
    
  });  

  
  $('#visualizarcontrato').modal('show');
 
}   

//carrega as informações do contrato para editar
function editarContratoAnt(json){

var url = ('../api/bndes/v1/siaf_contratos/' + json )

$.ajax({
  
  type: 'GET',
  url : url,
  
      success: function(editarContratoAnt){
     
        
      var ctr = JSON.parse(editarContratoAnt);
      
      $.each(ctr, function(key, value){

          $("#cnpj_cliente_editar").html(value.CNPJ.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, "$1.$2.$3/$4-$5"));
          $("#nome_cliente_editar").html(value.CLIENTE);

        $("#contrato_bndes_editar").val(value.CONTRATO_BNDES);
        $("#contrato_caixa_editar").val(value.CONTRATO_CAIXA);
        $("#conta_corrente_editar").val(value.CONTA_CORRENTE);
        $("#valor_editar").val(value.VL_AMORTIZADO);
        $("#tipo_editar").val(value.TP_AMORTIZACAO);
        // $("#form_status_editar").val(value.STATUS);  
        $("#pv_editar").val(value.COD_PA);  
        $("#sr_editar").val(value.COD_SR);
        $("#gigad_editar").val(value.COD_GIGAD);
        $("#obs_editarAnt").val(value.CO_OBS);
                       
       

      });
   
  }

});  


$('#editarcontrato').modal('show');

}   


