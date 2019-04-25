
// quando o documento carrega chama a função que carrega os dados dos contratos de acordo com o perfil

$(document).ready(function(){
   
    carregarDadosAgencia();
   
 });	

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
    }
});

// carrega tabela dos clientes da agência de acordo com o Perfil 

function carregarDadosAgencia()
{
    $.getJSON('../api/bndes/v1/siaf_contratos', function(json){

        $.each(json, function (key, value){

            linha = atualizaTabelaAgencia(value);
            $('#tabelaContratosLiquidar>tbody').append(linha);

        }
        
        );
        $("#tabelaContratosLiquidar").DataTable({
            responsive: true
        } );

    });
}

function atualizaTabelaAgencia(json)
{
	bDestroy : true,
	
	linha = '<tr>' +
				
                
                '<td>' + json.cliente	+ '</td>' +
				'<td>' + json.cnpj.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, "$1.$2.$3/$4-$5") + '</td>' +
				'<td>'	+				
					'<button class="btn btn-info btn-xs tip visualiza icon-pencil3 center-block" id="botaoCadastrar" onclick ="visualizaContrato(\'' + json.cnpj + '\')" ></button> ' + 
				'</td>' +
                
            '</tr>';
    return linha;
   
}

    // remove os dados do modal e inclui o da nova pesquisa   
    jQuery('#modalCadastramento').on('hidden.bs.modal', function (e) {
    jQuery(this).removeData('#tabCadastrar>tbody');
    jQuery(this).find('#tabCadastrar>tbody').empty();
    
})
// carrega todos os contratos dos clientes para solicitar amortizacao

   function visualizaContrato(json){

      var url = ('../api/bndes/v1/siaf_contratos/' + json )
      
    $.ajax({
        
        type: 'GET',
        url : url,
        
            success: function(carregaContratos){
           
              
            var contratos = JSON.parse(carregaContratos);
            var i = 0;
            $.each(contratos, function(key, value){
                //coloca os dados do cliente na parte de cima do modal
                $("#cnpj_cliente").html(value.cnpj.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, "$1.$2.$3/$4-$5"));
                $("#nome_cliente").html(value.cliente);
                
                //verifica o tipo de contrato para escolher qual numero de contrato do BNDES mostrar
                if (value.operacao == '717')
                             
            linhaCadastro = '<tr>' +

                                                   
                                '<td><input placeholder ="..." type="text" name="contratoBndes'+i+'" class=" contratoBndes form-control" value="' + value.contratoBndes + '" id="ctrBndes' + [i]+'"/></td>' +
                                '<td><input placeholder ="..." type="text" name="contratoCaixa'+i+'"class="contratoCaixa form-control" value="' + value.contratoCaixa + '" id="ctrCaixa' + [i]+'"/readonly></td>' +
                                '<td><input placeholder ="..." type="text" name="conta'+i+'"class="conta form-control" value="' + value.contaDebito	+ '"id="contaDebito' + [i]+'"/></td>' +
                                '<td><input type="text" placeholder="Informe o valor" name="valorAmortizacao'+i+'""class="valorAmortizacao dinheiro form-control" id="valorAmort' + [i]+'" /></td>' +
                                '<td><select id="tipoAmort' + [i]+'" name="tipoAmortizacao'+i+'"" class=" tipoAmortizacao form-control"><option disabled selected value>Selecione o tipo:</option> <option value="A">Amortização</option> <option value="L">Liquidação</option> </select></td>' +
                                
                            '</tr>';
                            

                else

            linhaCadastro = '<tr>' +

                                '<td><input placeholder ="..." type="text" name="contratoBndes'+i+'" class=" contratoBndes form-control" value="' + value.contratoBndesFiname + '" id="ctrBndes' +[i]+'"/></td>' +
                                '<td><input placeholder ="..." type="text" name="contratoCaixa'+i+'"class="contratoCaixa form-control" value="' + value.contratoCaixa + '" id="ctrCaixa' +[i]+'"/readonly></td>' +
                                '<td><input placeholder ="..." type="text" name="conta'+i+'"class="conta form-control" value="' + value.contaDebito	+ '"id="contaDebito' + [i]+'"/></td>' +
                                '<td><input type="text" placeholder="Informe o valor" name="valorAmortizacao'+i+'" class="valorAmortizacao dinheiro form-control"  id="valorAmort' + [i]+'" /></td>' +
                                '<td><select id="tipoAmort' + [i]+'" name="tipoAmortizacao'+i+'" class=" tipoAmortizacao form-control"><option disabled selected value>Selecione o tipo:</option> <option value="A">Amortização</option> <option value="L">Liquidação</option> </select></td>' +
            
                            '</tr>';

            //adiciona linha ao modal
            $('#tabCadastrar>tbody').append(linhaCadastro);
            //coloca mascara de valor 
            $("input.dinheiro").maskMoney({showSymbol:true, symbol:"R$", decimal:",", thousands:"."});

            
                i++;
            });
         
        }
      
    });  

    
    $('#modalCadastramento').modal('show');
   
}   
 
            
  
     
//  envia dados para o banco
    $('.cadAmortizacao').click(function(){
        enviarSolicitacaoAmortizacao();
    })

    $('#formulario_pedido_amortizacao').submit(function(event){
        event.preventDefault();
    });
	
function enviarSolicitacaoAmortizacao() {
    var pedidos = $('#tabCadastrar>tbody>tr').length;
    var cadastro = [];

    for(i = 0; i < pedidos; i++) {
        var pedido = {
            contratoBndes: $("#ctrBndes"+[i]).val(),
            contratoCaixa: $("#ctrCaixa"+[i]).val(),
            contaDebito: $("#contaDebito"+[i]).val(),
            valorAmortizacao: $("#valorAmort"+[i]).val(),
            tipoComando: $("#tipoAmort"+[i]).val(),
            observacoes: $("textarea.co_observacoes").val(),      
        }
        cadastro.push(pedido);
    }
    // $.post('https://inova.ceopc.des.caixa/sistemas/public/api/bndes/v1/siaf_amortizacoes', cadastro, function(dadosCadastrados){
    //     // jsonDados = JSON.parse(dadosCadastrados)
    //     console.log(cadastro);
    // });
    $.ajax({
        method: 'POST',
        cache: false,
        url: 'https://inova.ceopc.des.caixa/sistemas/public/api/bndes/v1/siaf_amortizacoes',
        data: {'data':cadastro},
        async: false,
        success: function (jsonStr) {
            console.log(jsonStr);           
        }
    });
}
    // console.log(cadastro);
// });
// }


 
    // $.ajax(
    //     {
    //         method: 'POST',
    //         url: 'https://inova.ceopc.des.caixa/sistemas/public/api/bndes/v1/siaf_contratos',
    //         data: $( "#formulario_pedido_amortizacao" ).serialize(),
    //         async: false,
    //         success: function (jsonStr) 
    //         {
    //             $(function()
    //             {

    //                 console.log(jsonStr);
    //             });
                
    //         }
    //     });

    // $.post('https://inova.ceopc.des.caixa/sistemas/public/api/bndes/v1/siaf_contratos', pedidoAmortizacao, function(demandaCadastrada){
    //     produto = JSON.parse(demandaCadastrada);
    //     console.log(produto);
    // });
// }
 
