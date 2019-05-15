function enviarSolicitacao(){
    try {
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
            success: function(ctr){
                // console.log(ctr);
                refreshTabela(ctr, 'tabelaAmortizaProx');
            }
        });
    } catch(Error) {
        console.log(Error);   
    }
}

function refreshTabela(tabelaAtualizada, idTabelaDataTable){
    $("#" + idTabelaDataTable).dataTable().fnDestroy();
    $("#" + idTabelaDataTable).empty(); 
    var novaTable = document.createElement('thead');
    var novaTableTr = document.createElement('tr');

    var novaTableThPedido = document.createElement('th');
    var tituloPedido = document.createTextNode("Pedido");
    novaTableThPedido.appendChild(tituloPedido);
    novaTableTr.appendChild(novaTableThPedido);

    var novaTableThTomador = document.createElement('th');
    var tituloTomador = document.createTextNode("Tomador");
    novaTableThTomador.appendChild(tituloTomador);
    novaTableTr.appendChild(novaTableThTomador);

    var novaTableThCtrCaixa = document.createElement('th');
    var tituloCtrCaixa = document.createTextNode("Ctr CAIXA");
    novaTableThCtrCaixa.appendChild(tituloCtrCaixa);
    novaTableTr.appendChild(novaTableThCtrCaixa);

    var novaTableThCtrBndes = document.createElement('th');
    var tituloCtrBndes = document.createTextNode("Ctr BNDES");
    novaTableThCtrBndes.appendChild(tituloCtrBndes);
    novaTableTr.appendChild(novaTableThCtrBndes);

    var novaTableThConta = document.createElement('th');
    var tituloConta = document.createTextNode("Conta");
    novaTableThConta.appendChild(tituloConta);
    novaTableTr.appendChild(novaTableThConta);

    var novaTableThValor = document.createElement('th');
    var tituloValor = document.createTextNode("Valor");
    novaTableThValor.appendChild(tituloValor);
    novaTableTr.appendChild(novaTableThValor);

    var novaTableThComando = document.createElement('th');
    var tituloComando = document.createTextNode("Comando");
    novaTableThComando.appendChild(tituloComando);
    novaTableTr.appendChild(novaTableThComando);

    var novaTableThStatus = document.createElement('th');
    var tituloStatus = document.createTextNode("Status");
    novaTableThStatus.appendChild(tituloStatus);
    novaTableTr.appendChild(novaTableThStatus);

    var novaTableThObs = document.createElement('th');
    var tituloObs = document.createTextNode("Obs");
    novaTableThObs.appendChild(tituloObs);
    novaTableTr.appendChild(novaTableThObs);
    
    var novaTableThEditar = document.createElement('th');
    var tituloEditar = document.createTextNode("Editar");
    novaTableThEditar.appendChild(tituloEditar);
    novaTableTr.appendChild(novaTableThEditar);
    var novaTableBody = document.createElement('tbody');
    
    novaTable.appendChild(novaTableTr);

    document.getElementById(idTabelaDataTable).appendChild(novaTable);
    document.getElementById(idTabelaDataTable).appendChild(novaTableBody);

    ObjTabelaAtualizada = JSON.parse(tabelaAtualizada);
    $.each(ObjTabelaAtualizada, function (key, value){         
        linhaProxLote = atualizaTabelaProxLote(value);
        $("#" + idTabelaDataTable + ">tbody").append(linhaProxLote);               
    });
    
    $("#" + idTabelaDataTable).DataTable({
        responsive: true, 
    });
    $("#" + idTabelaDataTable).css("width","100%");    
}
    
    //atualiza a tabela para visualizacao dos contrato para o prox lote
    function atualizaTabelaProxLoteAtualizada(json)
    {
    
    // $('#tabelaAmortizaProx').DataTable();
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
                    '<button class="btn btn-info btn-xs tip visualiza fa fa-binoculars center-block" id="botaoCadastrarProx" onclick ="visualizaContratoProxlote(\'' + json.codigoDemanda + '\')" ></button> ' + 
                '</td>' +
                '<td>'	+				
                    '<button class="btn btn-warning btn-xs tip edita fa fa-edit center-block" id="botaoEditarProx" onclick ="editarContratoProx(\'' + json.codigoDemanda	+ '\')" ></button> ' + 
                '</td>' +
                
            '</tr>';
              
    return linhaProxLote;
 
    }




