$(document).ready(function(){
   
    carregarTabelaGestor();
   
 });	

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
    }
});

// //carrega tabela com os contratos pendentes no Gestor
function carregarTabelaGestor()
{
    $.getJSON('../api/bndes/v1/siaf_contratos_gestor', function(json){

        $.each(json, function (key, value){
          
            linha = atualizaTabelaGestor(value);
            $('#tabelaGestor>tbody').append(linha);

        }
        
        );
       
        $('#tabelaGestor').DataTable({
            responsive: true,
        } );
           
    });
    
}

//atualiza a tabela para visualizacao dos contratos
function atualizaTabelaGestor(json)
{ 
    bDestroy : true,  
    linha = '<tr>' +         
                '<td>' + json.codigoDemanda        + '</td>' +
                '<td>' + json.nomeCliente      + '</td>' +
                '<td>' + json.contratoCaixa    + '</td>' +
                '<td>' + json.contratoBndes    + '</td>' +
                '<td>' + json.dataLote    + '</td>' +
                '<td>' + json.valorOperacao.replace(".", ",").replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.") + '</td>' +
                '<td>' + json.tipoOperacao.replace("A","AMORTIZAÇÃO").replace("L","LIQUIDAÇÃO")   + '</td>' +
                '<td>' + json.status.replace("GEPOD RESIDUO SIFBN","RESIDUO SIFBN")		        + '</td>' +
                '<td>'	+				
                    '<button class="btn btn-info btn-xs tip visualiza fa fa-binoculars center-block" id="botaoCadastrar" onclick ="visualizaDemanda(\'' + json.codigoDemanda + '\')" ></button> ' + 
                '</td>' +
                '<td>'	+				
                    '<button class="btn btn-warning btn-xs tip edita fa fa-edit center-block" id="botaoEditar" onclick ="editarContrato(\'' + json.codigoDemanda	+ '\')" ></button> ' + 
                '</td>' +
            '</tr>';
    return linha;
}