
var _tabelaLoteAnterior;

$(document).ready(function() {
    carregaDadosLoteAnterior();
    inicializarTodosDataTableSiafAmortizacoes();
});

// function carregaDadosLoteAnterior(){
//     $.getJSON('api/siaf_amortizacoes_lote_anterior', function(json){
//         $.each(json, function(key, value) {
//             linha = montarLinhaTabela(value);
//             $('#tabelaLoteAnterior>tbody').append(linha);
//             // console.log($('#tabelaLoteAnterior>tbody').append(linha));
//         });
        
//     });
// }

// function montarLinhaTabela(demanda){
//     var linha = '<tr>' + 
//                     '<td>' + demanda.codigo_pedido + '</td>' +
//                     '<td>' + demanda.nome_cliente + '</td>' +
//                     '<td>' + demanda.contrato_caixa + '</td>' +
//                     '<td>' + demanda.contrato_bndes + '</td>' +
//                     '<td>' + demanda.conta_corrente + '</td>' +
//                     '<td>' + demanda.valor_amortizado + '</td>' +
//                     '<td>' + demanda.tipo_amortizacao + '</td>' +
//                     '<td>' + demanda.status + '</td>' +
//                     '<td><button class="btn btn-info btn-xs tip visualiza title="Visualizar" > <b class="fa fa-binoculars "> </b>  </button></td>' +
//                     '<td><button class="btn btn-warning btn-xs tip edita title="Editar"> <b class="fa fa-edit"> </b>  </button></td>' +
//                 '</tr>';
//     return linha;
// }
function carregaDadosLoteAnterior(){

    $.ajax(
    {
        method: "GET",
        url: "api/siaf_amortizacoes_lote_anterior",
        // url: "../model/origemDados/queries/relatorio/json/indicadores_relatorio_atendimento_middle.json",
        dataType: "json",
    }
    ).done(function (json) 
    { 
        atualizarDataTableLoteAnterior(json);
    }
    ).fail(function (jqXHR, textStatus, errorThrown) 
    {
        console.log("deu erro");
        alert('Problemas ao tentar salvar!\n' + jqXHR.status + ' ' + jqXHR.statusText + errorThrown);
    });
};

function atualizarDataTableLoteAnterior(json) 
{
    
    _tabelaLoteAnterior.clear().draw(false);
    if (json != undefined && json != "") 
    {
        _tabelaLoteAnterior.rows.add(json).draw(true);
    }
}

function inicializarTodosDataTableSiafAmortizacoes()
{
    _tabelaLoteAnterior = $('#tabelaLoteAnterior').DataTable(
    {
        scrollCollapse: true,
        paging: false,
        lengthChange: false,
        pageLength: 10,
        bSort: true,
        searching: false,
        order: [0, "desc"],
        bAutoWidth: true,
        responsive: true,
        bInfo: false,
        columns: 
        [
            { data: "codigo_pedido", title: "#COD", class: "dt-center"},
            { data: "nome_cliente", title: "Tomador", class: "dt-center"},
            { data: "contrato_caixa", title: "Ctr CAIXA", class: "dt-center"}, 
            { data: "contrato_bndes", title: "Ctr BNDES", class: "dt-center"},
            { data: "conta_corrente", title: "Conta", class: "dt-center"}, 
            { data: "valor_amortizado", title: "Valor", class: "dt-center"}, 
            { data: "tipo_amortizacao", title: "Comando", class: "dt-center"}, 
            { data: "status", title: "Status", class: "dt-center"}, 
            { data: "Acao", // esse não influencia nada
                title: "Ação",
                
                render: function()
                {
                    var retorno = ""; 
                    btVisualizar = '<button class="btn btn-info btn-xs tip visualiza title="Visualizar" > <b class="fa fa-binoculars "> </b>  </button>';                                
                    btEditar = '<button class="btn btn-warning btn-xs tip edita title="Editar"> <b class="fa fa-edit"> </b>  </button>'; 
                    //Coloca a ordem
                    retorno =  btVisualizar + btEditar; 
                    //deve funcionar :) testa..
                    return retorno;
                },
                class: "dt-center"
            }
        ]
    });
}
            
