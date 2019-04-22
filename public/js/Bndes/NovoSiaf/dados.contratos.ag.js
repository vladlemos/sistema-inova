
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
            
            $.each(contratos, function(key, value){
                //coloca os dados do cliente na parte de cima do modal
                $("#cnpj_cliente").html(value.cnpj.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, "$1.$2.$3/$4-$5"));
                $("#nome_cliente").html(value.cliente);
                
                //verifica o tipo de contrato para escolher qual numero de contrato do BNDES mostrar
                if (value.operacao == '717')
                             
            linhaCadastro = '<tr class="dadosLinha">' +

                                                   
                                '<td><input placeholder ="..." type="text" name="contratoBndes" class=" contratoBndes form-control" value="' + value.contratoBndes + '" id="ctrBndesTeste"/></td>' +
                                '<td><input placeholder ="..." type="text" name="contratoCaixa"class="contratoCaixa form-control" value="' + value.contratoCaixa + '"/readonly></td>' +
                                '<td><input placeholder ="..." type="text" name="conta"class="conta form-control" value="' + value.contaDebito	+ '"/></td>' +
                                '<td><input type="text" placeholder="Informe o valor" name="valorAmortizacao"class="valorAmortizacao dinheiro form-control"  /></td>' +
                                '<td><select name="tipoAmortizacao" class=" tipoAmortizacao form-control"><option disabled selected value>Selecione o tipo:</option> <option value="A">Amortização</option> <option value="L">Liquidação</option> </select></td>' +
                                
                            '</tr>';
                            

                else

            linhaCadastro = '<tr class="dadosLinha">' +

                                '<td><input placeholder ="..." type="text" name="contratoBndes" class=" contratoBndes form-control" value="' + value.contratoBndesFiname + '" id="ctrBndesTeste"/></td>' +
                                '<td><input placeholder ="..." type="text" name="contratoCaixa"class="contratoCaixa form-control" value="' + value.contratoCaixa + '"/readonly></td>' +
                                '<td><input placeholder ="..." type="text" name="conta"class="conta form-control" value="' + value.contaDebito	+ '"/></td>' +
                                '<td><input type="text" placeholder="Informe o valor" name="valorAmortizacao" class="valorAmortizacao dinheiro form-control"  /></td>' +
                                '<td><select name="tipoAmortizacao" class=" tipoAmortizacao form-control"><option disabled selected value>Selecione o tipo:</option> <option value="A">Amortização</option> <option value="L">Liquidação</option> </select></td>' +
            
                            '</tr>';

            //adiciona linha ao modal
            $('#tabCadastrar>tbody').append(linhaCadastro);
            //coloca mascara de valor 
            $("input.dinheiro").maskMoney({showSymbol:true, symbol:"R$", decimal:",", thousands:"."});

            

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
	
function enviarSolicitacaoAmortizacao(){

    var pedidos =[];
$('#tabCadastrar>tbody>tr').each(function(){

    var colunasLinha = $(this).children();

    var pedido = {

            contratoBndes: $("input.contratoBndes").val(),
            contratoCaixa: $(colunasLinha[1]).text(),
            contaDebito: $(colunasLinha[2]).text(),
            valorAmortizacao: $(colunasLinha[3]).text(),
            tipoComando: $(colunasLinha[4]).text(),
            observacoes: $("textarea.co_observacoes").val(),
    }
    pedidos.push(pedido)
});
console.log(pedidos);

    // var pedidoAmortizacao= $('#form_contratos>td');
// var teste = document.getElementsByClassName('contratoBndes');

// var valores =[];

// for (i=0; i< teste.length; i++){
// var element = teste[i];
// var tr = element.closest('tr');
// if (tr.children[1].children[0]!==''){
//     valores[i]=tr.children[0].text();
//     // valores.push(teste[i].value);
// }
// console.log(valores);
// }

}

    // listaPedidoAmortizacao =  pedidoAmortizacao.lenght;

    

//    pedidoAmortizacao.forEach(pedido);

//    function pedido(value){
    // for (i= 0; i < pedidoAmortizacao.lenght; i++){

    // $.post("https://inova.ceopc.des.caixa/sistemas/public/api/bndes/v1/siaf_contratos", pedidoAmortizacao, function (ctr){
    //     for (i=0; i<pedidoAmortizacao[i]; i++){

    // $.each(pedidoAmortizacao, function (index, ctr){

    // var  ctr = {
        
    //         contratoBndes: $("input.contratoBndes").val(),
    //         contratoCaixa: $("input.contratoCaixa").val(),
    //         contaDebito: $("input.conta").val(),
    //         valorAmortizacao: $("input.dinheiro").val(),
    //         tipoComando: $("select.tipoAmortizacao").val(),
    //         observacoes: $("textarea.co_observacoes").val(),
           
    //         }
        

        // return ctr;
    //     console.log('estou aqui');
    // }
        // }
    // }
   
// });
// console.log(ctr)
// }


    // pedidoAmortizacao.lenght;
    // text = "<tr>";

    // for (i=0; i<pedidoAmortizacao[i]; i++){

    //   if ($("input.dinheiro").val() !==null){
       
    //        ctr={ 
    //         contratoBndes: $("input.contratoBndes").val(),
    //         contratoCaixa: $("input.contratoCaixa").val(),
    //         contaDebito: $("input.conta").val(),
    //         valorAmortizacao: $("input.dinheiro").val(),
    //         tipoComando: $("select.tipoAmortizacao").val()
    //     }
    //     console.log(ctr);
    //   }
            
    // }

    // console.log(pedidoAmortizacao);
    

    // $(pedidoAmortizacao).each(function(){
    
    // if ($("input.dinheiro").val() !==null){
    //     ctr ={
    //         contratoBndes: $("input.contratoBndes").val(),
    //         contratoCaixa: $("input.contratoCaixa").val(),
    //         contaDebito: $("input.conta").val(),
    //         valorAmortizacao: $("input.dinheiro").val(),
    //         tipoComando: $("select.tipoAmortizacao").val()
    //         }
    //     }
        
    // })
    // console.log(pedidoAmortizacao);
   

    // $.ajax({
        
    //     type: 'post',
    //     url = ('../api/bndes/v1/siaf_contratos/'),

    //     success: function(solicitaAmortizacao){

       

//   }
 
    // });
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
 
