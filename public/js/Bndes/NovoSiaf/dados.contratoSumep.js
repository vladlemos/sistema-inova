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
    // $('#tabelaSumep').DataTable();
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

    var url = ('../api/bndes/v2/siaf_amortizacoes/' + json )
    
  $.ajax({
      
      type: 'GET',
      url : url,
      
          success: function(carregaContratoSumep){
         
            
          var ctrSumep = JSON.parse(carregaContratoSumep);
         
        //   $.each(ctrSumep, function(key, value){
            
            $("#cnpj_cliente_modal").html(ctrSumep.cnpj.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, "$1.$2.$3/$4-$5"));
            $("#nome_cliente_modal").html(ctrSumep.nomeCliente);
                           
            $("#contrato_bndes_modal").val(ctrSumep.contratoBndes);
            $("#contrato_caixa_modal").val(ctrSumep.contratoCaixa);
            $("#conta_corrente_modal").val(ctrSumep.contaDebito);
            $("#valor_modal").val(ctrSumep.valorOperacao);
            $("#tipo_modal").val(ctrSumep.tipoOperacao);
            $("#status_modal").val(ctrSumep.status); 
            $("#pv_modal").val(ctrSumep.codigoPa);  
            $("#sr_modal").val(ctrSumep.codigoSr);
            $("#gigad_modal").val(ctrSumep.codigoGigad);
            // $("#obs_modalAnterior").val(value.CO_OBS);

        //   });
        var grids = ctrSumep;

for (var i=0; i < ctrSumep.length; i++) {
for(var j=0; j < ctrSumep[i].length; j++){
console.log(ctrSumep["+i+"][" + j+"]  +ctrSumep[i][j]);
}

}
       
    //    console.log(meuArray[0]);
    //    console.log(meuArray[0][6][1]);

        // $.each(ctrSumep, function(key, value){
        //      //carrega saldo da conta para débito
        //      var consulta = ctrSumep.map(function(value){
        //         return value.dataConsultaSaldo;


        //      });
          
            // linhaCadastroConta = '<tr>' +
                            
            //                     '<td><input type="text" name="dataConsultaConta" class="form-control" value="' + value.date + '" /readonly></td>' +
            //                     '<td><input type="text" name="statusConsultaConta"class="form-control" value="' + value.statusSaldo + '"/readonly></td>' +
            //                     '<td><input type="text" name="saldoDispConsultaConta" class="form-control" value="' + value.saldoDisponivel + '" /readonly></td>' +
            //                     '<td><input type="text" name="saldoBloqConsultaConta" class="form-control" value="' + value.saldoBloqueado + '" /readonly></td>' +
            //                     '<td><input type="text" name="limiteAzulConsultaConta" class="form-control" value="' + value.LimiteChequeAzul + '" /readonly></td>' +
            //                     '<td><input type="text" name="limiteGimConsultaConta" class="form-control" value="' + value.LimiteGim + '" /readonly></td>' +
            //                     '<td><input type="text" name="saldoTotalConsultaConta" class="form-control" value="' + value.saldoTotal + '" /readonly></td>' +
                                
            //                     '</tr>';
    
            // return linhaCadastroConta;
      
    
        // });  


            $('#visualizarcontrato').modal('show');
 
        }  
  }); 
}

function editarContratoSumep(json){

var url = ('../api/bndes/v2/siaf_amortizacoes/' + json )

$.ajax({
  
  type: 'GET',
  url : url,
  
      success: function(editaContratoSumep){
     
        
      var ctrSumep = JSON.parse(editaContratoSumep);
      
      $.each(ctrSumep, function(key, value){

        //carrega dados do cliente na parte de cima do modal
          $("#cnpj_cliente_editar").val(value.cnpj.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, "$1.$2.$3/$4-$5"));
          $("#nome_cliente_editar").html(value.nomeCliente);
        // carrega dados do contrato no modal
        $("#contrato_bndes_editar").val(value.contratoBndes);
        $("#contrato_caixa_editar").val(value.contratoCaixa);
        $("#conta_corrente_editar").val(value.contaDebito);
        $("#valor_editar").val(value.valorOperacao.replace('.', ',').replace(/(\d)(?=(\d{3})+\,)/g, "$1."));
        $("#tipo_editar").val(value.tipoOperacao);
        $("#status_editar").val(value.status);  
        $("#pv_editar").val(value.codigoPa);  
        $("#sr_editar").val(value.codigoSr);
        $("#gigad_editar").val(value.codigoGigad);

     

        //carrega saldo da conta para débito
        // linhaCadastroConta = '<tr>' +
                        
        //                     '<td><input type="text" name="dataConsultaConta" class="form-control" value="' + value.date + '" /readonly></td>' +
        //                     '<td><input type="text" name="statusConsultaConta"class="form-control" value="' + value.statusSaldo + '"/readonly></td>' +
        //                     '<td><input type="text" name="saldoDispConsultaConta" class="form-control" value="' + value.saldoDisponivel + '" /readonly></td>' +
        //                     '<td><input type="text" name="saldoBloqConsultaConta" class="form-control" value="' + value.saldoBloqueado + '" /readonly></td>' +
        //                     '<td><input type="text" name="limiteAzulConsultaConta" class="form-control" value="' + value.LimiteChequeAzul + '" /readonly></td>' +
        //                     '<td><input type="text" name="limiteGimConsultaConta" class="form-control" value="' + value.LimiteGim + '" /readonly></td>' +
        //                     '<td><input type="text" name="saldoTotalConsultaConta" class="form-control" value="' + value.saldoTotal + '" /readonly></td>' +
                            
        //                 '</tr>';

        // return linhaCadastroConta;
        // $("#obs_editarAnt").val(value.CO_OBS);
                       
    });

      
   
  }

});  


$('#editarcontrato').modal('show');

}   

