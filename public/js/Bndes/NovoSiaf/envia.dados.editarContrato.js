
//não estamos usando essa
function enviarSolicitacao(){
try{

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
    refreshTabela();
  
}
catch(Error){
    console.log(Error);
     
 }
}

function refreshTabela(){
  
    $.getJSON('../api/bndes/v1/siaf_amortizacoes_lote_atual', function(json){

        $('#tabelaAmortizaProx tbody').dataTable().fnDestroy()();


        $.each(json, function (key, value){
        
            linhaProxLote = atualizaTabelaProxLoteAtualizada(value);
            $('#tabelaAmortizaProx>tbody').append(linhaProxLote);
            
        }
        
        );
       
        $('#tabelaAmortizaProx').DataTable({
            responsive: true,
           
        } );

    });
    
    }
    
    //atualiza a tabela para visualizacao dos contrato para o prox lote
    function atualizaTabelaProxLoteAtualizada(json)
    {
    //destroi a tabela anterior e cria uma nova    
    bDestroy : true,
    
    linhaProxLote = '<tr>' +
                
                
                '<td>' + json.codigoDemanda        + '</td>' +
                '<td>' + json.nomeCliente      + '</td>' +
                '<td>' + json.contratoCaixa    + '</td>' +
                '<td>' + json.contratoBndes    + '</td>' +
                '<td>' + json.contaDebito    + '</td>' +
                '<td>' + json.valorOperacao.replace(".", ",").replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.") + '</td>' +
                '<td>' + json.tipoOperacao.replace("A","AMORTIZAÇÃO").replace("L","LIQUIDAÇÃO")   + '</td>' +
                '<td>' + json.status	        + '</td>' +
    
                '<td>'	+				
                    '<button class="btn btn-info btn-xs tip visualiza fa fa-binoculars center-block" id="botaoCadastrarProx" onclick ="visualizaDemanda(\'' + json.codigoDemanda + '\')" ></button> ' + 
                '</td>' +
                '<td>'	+				
                    '<button class="btn btn-warning btn-xs tip edita fa fa-edit center-block" id="botaoEditarProx" onclick ="editarContratoProx(\'' + json.codigoDemanda	+ '\')" ></button> ' + 
                '</td>' +
                
            '</tr>';
              
    return linhaProxLote;
 
    }




