function enviarSolicitação(){


    ctr = {
      
            contratoBndes : $("#contrato_bndes_editar").val(), 

            contaDebito : $("#conta_corrente_editar").val(), 
            valorOperacao : $("#valor_editar").val().replace(".","").replace(",","."), 
            tipoOperacao : $("#tipo_editar").val(), 
            status : $("#status_editar").val(),   
     
            observacoes : $("#observacaoContrato").val(),
    
    }
    $.ajax({
    
        type: 'PUT',
        url : '../api/bndes/v2/siaf_amortizacoes/' + $("#codDemanda").val() ,
        context : this,
        data: ctr,
        sucess: function(data){
    

        }
     
    });
  
    console.log(ctr);
    $('#tabelaAmortizaProx').ajax.reload();
    
