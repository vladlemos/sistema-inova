// quando o documento carrega chama a função que carrega os dados dos contratos amortizados/liquidados nos ultimos 12 meses

$(document).ready(function(){
   
    carregarDados12meses();
   
 });	

 //token segurança do laravel
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
    }
});

// carrega tabela dos clientes dos ultimos 12 meses

function carregarDados12meses(){

    $.getJSON('../api/bndes/v1/lista_solicitacoes_ultimos_doze_meses', function(json){

        $.each(json, function (key, value){

            linha = atualizaTabela12meses(value);
            $('#tabelaPesquisaSolicitacoes>tbody').append(linha);

        });

        // transforma a tabela em data table
        $("#tabelaPesquisaSolicitacoes").DataTable();

    });
}

//função que monta a tabela com os clientes de acordo com o perfil
function atualizaTabela12meses(json){
    //destroy a table para criar uma nova com os dados
	bDestroy : true,
	
	linha = '<tr>' +
				
                '<td>' + json.codigoDemanda + '</td>' +
                '<td>' + json.cnpj.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, "$1.$2.$3/$4-$5")	+ '</td>' +
                '<td>' + json.contratoCaixa + '</td>' +
                '<td>' + json.nomeCliente+ '</td>' +
                '<td>' + json.valorOperacao.replace(".", ",").replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.")  + '</td>' +               
                '<td>' + json.dataLote + '</td>' +
				'<td>'	+				
					'<button class="btn btn-info btn-xs tip visualiza fa fa-binoculars center-block" id="botaoCadastrar" onclick ="visualizaContrato12meses(\'' + json.codigoDemanda + '\')" ></button> ' + 
				                
            '</tr>';
    return linha;
   
}

    function visualizaContrato12meses(json){

            
        $.get( '../api/bndes/v2/siaf_amortizacoes/' + json, function(dados) {

            var dados = JSON.parse(dados);
            console.log(dados);
            for(i = 0; i < dados.consultaSaldo.length; i++){
                linha = montaLinhaTabelaSaldo(dados.consultaSaldo[i]);
                        
                $('#tabHistoricoSaldo>tbody').append(linha);
            }              
            function montaLinhaTabelaSaldo(dadosSaldo)
            {
                bDestroy= true;

                linha = '<tr>' +
                            '<td>' + dadosSaldo.codigoConsultaSaldo + '</td>' +
                            '<td>' + dadosSaldo.dataConsultaSaldo + '</td>' +
                            '<td>' + dadosSaldo.statusSaldo + '</td>' +
                            '<td>' + dadosSaldo.saldoDisponivel + '</td>' +
                            '<td>' + dadosSaldo.saldoBloqueado + '</td>' +
                            '<td>' + dadosSaldo.LimiteChequeAzul + '</td>' +
                            '<td>' + dadosSaldo.LimiteGim + '</td>' +
                            '<td>' + dadosSaldo.saldoTotal + '</td>' +
                        '</tr>';
                return linha;

        
            }
            
            for(i = 0; i < dados.historicoContrato.length; i++){
                linha = montaLinhaTabelaHistorico(dados.historicoContrato[i]);
                
                $('#tabHistoricoContrato>tbody').append(linha);
                $('#obs_modal').html(dados.historicoContrato[i].observacaoHistorico);
                
            }              
            function montaLinhaTabelaHistorico(dadosHistorico)
            {
                bDestroy= true;
                linha = '<tr>' +
                            '<td>' + dadosHistorico.codigoHistorico + '</td>' +
                            '<td>' + dadosHistorico.dataHistorico + '</td>' +
                            '<td>' + dadosHistorico.statusHistorico + '</td>' +
                            '<td>' + dadosHistorico.observacaoHistorico + '</td>' +
                            '<td>' + dadosHistorico.matriculaResponsavel + '</td>' +
                            '<td>' + dadosHistorico.unidadeResponsavel + '</td>' +
                        '</tr>';

                
                return linha;
                
            }
            
            $('#nome_cliente_modal').html(dados.nomeCliente);
            $('#cnpj_cliente_modal').html(dados.cnpj.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, "$1.$2.$3/$4-$5"));
            $('#status_modal').val(dados.status);
            $('#contrato_caixa_modal').val(dados.contratoCaixa);
            $('#contrato_bndes_modal').val(dados.contratoBndes);
            $('#conta_corrente_modal').val(dados.contaDebito);
            $('#tipo_modal').val(dados.tipoOperacao);
            $('#valor_modal').val(dados.valorOperacao);
            $('#pv_modal').val(dados.codigoPa);
            $('#sr_modal').val(dados.codigoSr);
            $('#gigad_modal').val(dados.codigoGigad);


        jQuery('#visualizarcontrato').on('hidden.bs.modal', function (e) {
        jQuery(this).removeData('#tabHistoricoSaldo>tbody');
        jQuery(this).find('#tabHistoricoSaldo>tbody').empty();
        jQuery(this).removeData('#tabHistoricoContrato>tbody');
        jQuery(this).find('#tabHistoricoContrato>tbody').empty();
        })
    });  

        $('#visualizarcontrato').modal('show');
    }



