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
          
            linha = atualizaTabela(value);
            $('#tabelaGestor>tbody').append(linha);

        }
        
        );
       
        $('#tabelaGestor').DataTable({
            responsive: true,
        } );
           
    });
    
}
