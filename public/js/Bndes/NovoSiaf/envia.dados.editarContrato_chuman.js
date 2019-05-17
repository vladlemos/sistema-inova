var idTabelaDataTable = '';
// let retornoIdTabela = '';

function enviarSolicitacao()
{
    idTabela();
    try {
        ctr = {       
            contratoBndes : $("#contrato_bndes_editar").val(), 
            contaDebito : $("#conta_corrente_editar").val(), 
            valorOperacao : $("#valor_editar").val().replace(".","").replace(",","."), 
            tipoOperacao : $("#tipo_editar").val(), 
            status : $("#status_editar").val(),       
            observacoes : $("#observacaoContrato").val(),    
            loteDataTable: $("#lote").val(),
        }
        // console.log(ctr);
        if ($("#status_editar").val() === 'CANCELADO' || $("#status_editar").val() === 'EXCLUIDO UD') {
            $.ajax({       
                type: 'PUT',
                url : '../api/bndes/v2/siaf_amortizacoes/' + $("#codDemanda").val() ,
                context : this,
                data: ctr,
                success: function(ctr){
                    refreshTabela(ctr, idTabelaDataTable);
                    atualizaDataTableCadastroDemanda(); 
                    console.log('fim');
                }
            });
        } else {
            $.ajax({       
                type: 'PUT',
                url : '../api/bndes/v2/siaf_amortizacoes/' + $("#codDemanda").val() ,
                context : this,
                data: ctr,
                success: function(ctr){
                    refreshTabela(ctr, idTabelaDataTable); 
                }
            });
        }
        
    } catch(Error) {
        console.log(Error);   
    }
}

function refreshTabela(tabelaAtualizada, idTabelaDataTable)
{
    $("#" + idTabelaDataTable).DataTable().fnDestroy();
    $("#" + idTabelaDataTable).empty(); 

    let novaTable = document.createElement('thead');
    let novaTableTr = document.createElement('tr');

    let novaTableThPedido = document.createElement('th');
    let tituloPedido = document.createTextNode("Pedido");
    novaTableThPedido.appendChild(tituloPedido);
    novaTableTr.appendChild(novaTableThPedido);

    let novaTableThTomador = document.createElement('th');
    let tituloTomador = document.createTextNode("Tomador");
    novaTableThTomador.appendChild(tituloTomador);
    novaTableTr.appendChild(novaTableThTomador);

    let novaTableThCtrCaixa = document.createElement('th');
    let tituloCtrCaixa = document.createTextNode("Ctr CAIXA");
    novaTableThCtrCaixa.appendChild(tituloCtrCaixa);
    novaTableTr.appendChild(novaTableThCtrCaixa);

    let novaTableThCtrBndes = document.createElement('th');
    let tituloCtrBndes = document.createTextNode("Ctr BNDES");
    novaTableThCtrBndes.appendChild(tituloCtrBndes);
    novaTableTr.appendChild(novaTableThCtrBndes);

    let novaTableThConta = document.createElement('th');
    let tituloConta = document.createTextNode("Conta");
    novaTableThConta.appendChild(tituloConta);
    novaTableTr.appendChild(novaTableThConta);

    let novaTableThValor = document.createElement('th');
    let tituloValor = document.createTextNode("Valor");
    novaTableThValor.appendChild(tituloValor);
    novaTableTr.appendChild(novaTableThValor);

    let novaTableThComando = document.createElement('th');
    let tituloComando = document.createTextNode("Comando");
    novaTableThComando.appendChild(tituloComando);
    novaTableTr.appendChild(novaTableThComando);

    let novaTableThStatus = document.createElement('th');
    let tituloStatus = document.createTextNode("Status");
    novaTableThStatus.appendChild(tituloStatus);
    novaTableTr.appendChild(novaTableThStatus);

    let novaTableThObs = document.createElement('th');
    let tituloObs = document.createTextNode("");
    novaTableThObs.appendChild(tituloObs);
    novaTableTr.appendChild(novaTableThObs);
    
    let novaTableThEditar = document.createElement('th');
    let tituloEditar = document.createTextNode("");
    novaTableThEditar.appendChild(tituloEditar);
    novaTableTr.appendChild(novaTableThEditar);
    let novaTableBody = document.createElement('tbody');
    
    novaTable.appendChild(novaTableTr);

    document.getElementById(idTabelaDataTable).appendChild(novaTable);
    document.getElementById(idTabelaDataTable).appendChild(novaTableBody);

    ObjTabelaAtualizada = JSON.parse(tabelaAtualizada);
    $.each(ObjTabelaAtualizada, function (key, value){         
        linha = atualizaTabela(value);
        $("#" + idTabelaDataTable + ">tbody").append(linha);               
    });
    
    $("#" + idTabelaDataTable).DataTable({
        responsive: true, 
    });
    $("#" + idTabelaDataTable).css("width","100%");    
}
    
//atualiza a tabela para visualizacao dos contrato para o prox lote
function atualizaTabela(json)
{ 
    bDestroy : true,  
    linha = '<tr>' +         
                '<td>' + json.codigoDemanda        + '</td>' +
                '<td>' + json.nomeCliente      + '</td>' +
                '<td>' + json.contratoCaixa    + '</td>' +
                '<td>' + json.contratoBndes    + '</td>' +
                '<td>' + json.contaDebito    + '</td>' +
                '<td>' + json.valorOperacao.replace(".", ",").replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.") + '</td>' +
                '<td>' + json.tipoOperacao.replace("A","AMORTIZAÇÃO").replace("L","LIQUIDAÇÃO")   + '</td>' +
                '<td>' + json.status	        + '</td>' +
                '<td>'	+				
                    '<button class="btn btn-info btn-xs tip visualiza fa fa-binoculars center-block" id="botaoCadastrar" onclick ="visualizaDemanda(\'' + json.codigoDemanda + '\')" ></button> ' + 
                '</td>' +
                '<td>'	+				
                    '<button class="btn btn-warning btn-xs tip edita fa fa-edit center-block" id="botaoEditar" onclick ="editarContrato(\'' + json.codigoDemanda	+ '\')" ></button> ' + 
                '</td>' +
            '</tr>';
    return linha;
}