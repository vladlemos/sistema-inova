

$(document).ready(function(){
   
    carregarDadosAgencia();
   
 });	

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
    }
});

function carregarDadosAgencia()
{
    $.getJSON('../api/bndes/v1/siaf_contratos', function(json){

        $.each(json, function (key, value){

            linha = atualizaTabelaAgencia(value);
            $('#tabelaContratosLiquidar>tbody').append(linha);

        }
        
        );
        $("#tabelaContratosLiquidar").DataTable();

    });
}

function atualizaTabelaAgencia(json)
{
	bDestroy : true,
	
	linha = '<tr>' +
				
                
                '<td>' + json.CLIENTE	+ '</td>' +
				'<td>' + json.CNPJ.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, "$1.$2.$3/$4-$5") + '</td>' +
				'<td>'	+				
					'<button class="btn btn-info btn-xs tip visualiza icon-pencil3 center-block" id="botaoCadastrar" onclick ="visualizaContrato(\'' + json.CNPJ + '\')" ></button> ' + 
				'</td>' +
                
            '</tr>';
    return linha;
   
}


   function visualizaContrato(json){

      var url = ('../api/bndes/v1/siaf_contratos/' + json )
      
    $.ajax({
        
        type: 'GET',
        url : url,
        
            success: function(carregaContratos){
           
              
            var contratos = JSON.parse(carregaContratos);
            
            $.each(contratos, function(key, value){

                $("#cnpj_cliente").html(value.CNPJ);
                $("#nome_cliente").html(value.CLIENTE);
                             
            linhaCadastro = '<tr>' +

                                '<td><input placeholder ="..." type="text" class=" contratoBndes form-control" value="' + value.CONTRATO_BNDES_2 + ' "/></td>' +
                                '<td><input placeholder ="..." type="text" class="contratoCaixa form-control" value="' + value.CONTRATO_CAIXA + '"/readonly></td>' +
                                '<td><input placeholder ="..." type="text" class="conta form-control" value="' + value.CONTA	+ '"/></td>' +
                                '<td><input type="text" placeholder="Informe o valor" class="dinheiro form-control"  /></td>' +
                                '<td><select class=" tipoAmortizacao form-control"><option disabled selected value>Selecione o tipo:</option> <option value="A">Amortização</option> <option value="L">Liquidação</option> </select></td>' +
                                
                            '</tr>';
          
            $('#tabCadastrar>tbody').append(linhaCadastro);
            $("input.dinheiro").maskMoney({showSymbol:true, symbol:"R$", decimal:",", thousands:"."});

            });
         
        }
      
    });  

    
    $('#modalCadastramento').modal('show');
   
}   
           
    jQuery('#modalCadastramento').on('hidden.bs.modal', function (e) {
	    jQuery(this).removeData('#tabCadastrar>tbody');
        jQuery(this).find('#tabCadastrar>tbody').empty();
       
	})
            
  
     
 
    $('.cadAmortizacao').click(function(){

        enviarSolicitacaoAmortizacao();
    })

    $('#formulario_pedido_amortizacao').submit(function(event){
        event.preventDefault();
    });
	
function enviarSolicitacaoAmortizacao(){
    ctr ={
        contratoBndes: $("input.contratoBndes").val(),
        contratoCaixa: $("input.contratoCaixa").val(),
        contaDebito: $("input.conta").val(),
        valorAmortizacao: $("input.dinheiro").val(),
        tipoComando: $("input.tipoAmortizacao").val()
    }
    // $.ajax({
        
    //     type: 'post',
    //     url = ('../api/bndes/v1/siaf_contratos/'),

    //     success: function(solicitaAmortizacao){

       

//   }
 
    // });

    $.post('https://inova.ceopc.des.caixa/sistemas/public/api/bndes/v1/siaf_contratos', ctr, function(demandaCadastrada){
        produto = JSON.parse(demandaCadastrada);
        console.log(produto);
    });
}
 
