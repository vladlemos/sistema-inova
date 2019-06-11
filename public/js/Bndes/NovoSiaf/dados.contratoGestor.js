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
          
            linha = atualizaTabela(value);
            $('#tabelaSumep>tbody').append(linha);

        }
        
        );
       
        $('#tabelaSumep').DataTable({
            responsive: true,
        } );
           
    });
    
}
