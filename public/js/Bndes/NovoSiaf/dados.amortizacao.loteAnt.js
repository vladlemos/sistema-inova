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

    var url = ('../api/bndes/v2/siaf_amortizacoes/' + json )
    
  $.ajax({
      
      type: 'GET',
      url : url,
      
          success: function(carregaContratoAnt){
         
            
          var ctrAnt = JSON.parse(carregaContratoAnt);
        
        //   $.each(ctrAnt, function(key, value){

            $("#cnpj_cliente_modal").html(ctrAnt.cnpj.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, "$1.$2.$3/$4-$5"));
            $("#nome_cliente_modal").html(ctrAnt.nomeCliente);
                           
            $("#contrato_bndes_modal").val(ctrAnt.contratoBndes);
            $("#contrato_caixa_modal").val(ctrAnt.contratoCaixa);
            $("#conta_corrente_modal").val(ctrAnt.contaDebito);
            $("#valor_modal").val(ctrAnt.valorOperacao);
            $("#tipo_modal").val(ctrAnt.tipoOperacao);
            $("#status_modal").val(ctrAnt.status);  
            $("#pv_modal").val(ctrAnt.codigoPa);  
            $("#sr_modal").val(ctrAnt.codigoSr);
            $("#gigad_modal").val(ctrAnt.codigoGigad);
            // $("#obs_modalAnterior").val(ctrAnt.CO_OBS);

        //   });
       
      }
    
  });  

  
  $('#visualizarcontrato').modal('show');
 
}   

//carrega as informações do contrato para editar
function editarContratoAnt(json){

var url = ('../api/bndes/v2/siaf_amortizacoes/' + json )

$.ajax({
  
  type: 'GET',
  url : url,
  
      success: function(editarContratoAnt){
     
        
      var ctrAnt = JSON.parse(editarContratoAnt);
      
    //   $.each(ctr, function(key, ctrAnt){

          $("#cnpj_cliente_editar").html(ctrAnt.cnpj.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, "$1.$2.$3/$4-$5"));
          $("#nome_cliente_editar").html(ctrAnt.nomeCliente);

        $("#contrato_bndes_editar").val(ctrAnt.contratoBndes);
        $("#contrato_caixa_editar").val(ctrAnt.contratoCaixa);
        $("#conta_corrente_editar").val(ctrAnt.contaDebito);
        $("#valor_editar").val(ctrAnt.valorOperacao);
        $("#tipo_editar").val(ctrAnt.tipoOperacao);
        $("#status_editar").val(ctrAnt.status);  
        $("#pv_editar").val(ctrAnt.codigoPa);  
        $("#sr_editar").val(ctrAnt.codigoSr);
        $("#gigad_editar").val(ctrAnt.codigoGigad);
        // $("#obs_editarAnt").val(ctrAnt.CO_OBS);
                       
       

    //   });
   
  }

});  


$('#editarcontrato').modal('show');

}   


