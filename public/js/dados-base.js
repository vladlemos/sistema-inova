

$(document).ready(function(){
    carregarDadosAgencia();

});	

function carregarDadosAgencia()
{
    $.getJSON('api/siaf_contratos', function(json){

        $.each(json, function (key, value){

            linha = atualizaTabelaAgencia(value);
            $('#tabelaContratosLiquidar>tbody').append(linha);

            // console.log(linha);
        }
        
        );
        $("#tabelaContratosLiquidar").DataTable();

    });
}
	// $.getJSON('api/siaf_contratos', function(json)
    // {
        
		
        // for(i = 0; i < json.length; i++)
        // {
        //     linha = atualizaTabela(json[i]);
		// 	$('#tabelaContratosLiquidar>tbody').append(linha);
		
		// }  
		
		// $("#tabelaContratosLiquidar").DataTable();
    // });
// }
function atualizaTabelaAgencia(json)
{
	bDestroy : true,
	
	linha = '<tr>' +
				
                // '<td>' + json.CONTRATO_CAIXA + '</td>' +
                '<td>' + json.CLIENTE	+ '</td>' +
				'<td>' + json.CNPJ.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, "$1.$2.$3/$4-$5") + '</td>' +
				'<td>'	+				
					'<button class="btn btn-info btn-xs tip visualiza icon-pencil3 " id="botaoCadastrar" onclick ="visualizaContrato(\'' + json.CNPJ + '\')" ></button> ' + 
				'</td>' +
                // '<td>' + 
                    // '<button id="botaoEditar" class="btn btn-warning btn-xs tip edita fa fa-edit" onclick ="editarContrato()"  ></button>' + 
                // '</td>' +
            '</tr>';
    return linha;
   
}


   function visualizaContrato(json){
      var url = ('http://www.ceopc.hom.sp.caixa/bndes/public/api/siaf_contratos/' + json )
      
    $.ajax({
        
        type: 'GET',
        url : url,
        success: function(carregaContratos){
           
              
            var contratos = JSON.parse(carregaContratos);
            
            $.each(contratos, function(i, value){
          
            linhaCadastro = '<tr>' +
                                '<td>' + value.CONTRATO_BNDES + '</td>' +
                                '<td>' + value.CONTRATO_CAIXA + '</td>' +
                                '<td>' + value.CONTA	+ '</td>' +
                                '<td>' + value.Valor + '</td>' +
                                '<td>' + value.Comando + '</td>' +
                                
                            '</tr>';
            return linhaCadastro;
         
            });
            $('#tabCadastrar>tbody').append(linhaCadastro);
           
        }
      
    });  
   
    $('#modalCadastramento').modal('show');
    
    jQuery('#modalCadastramento').on('hidden.bs.modal', function (e) {
	    jQuery(this).removeData('#tabCadastrar>tbody');
	    jQuery(this).find('#tabCadastrar>tbody').empty();
	})
   
}   
                   




    // function editarContrato(){

    //     $('#editarcontrato').modal('show');
       
    // };


 
