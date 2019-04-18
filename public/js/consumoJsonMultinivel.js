
$( document ).ready(function() {
    consumoJsonMultinivel();
});

function consumoJsonMultinivel(){
    $.get( "api/bndes/v2/siaf_amortizacoes/3000", function(dados) {
        var dados = JSON.parse(dados);
        console.log(dados);
        for(i = 0; i < dados.consultaSaldo.length; i++){
            linha = montaLinhaTabelaSaldo(dados.consultaSaldo[i]);
            $('#tabelaConsultaSaldo>tbody').append(linha);
        }              
        function montaLinhaTabelaSaldo(dadosSaldo)
        {
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
            $('#tabelaHistoricoContrato>tbody').append(linha);
        }              
        function montaLinhaTabelaHistorico(dadosHistorico)
        {
            linha = '<tr>' +
                        '<td>' + dadosHistorico.codigoHistorico + '</td>' +
                        '<td>' + dadosHistorico.dataHistorico + '</td>' +
                        '<td>' + dadosHistorico.statusHistorico + '</td>' +
                        '<td>' + dadosHistorico.matriculaResponsavel + '</td>' +
                        '<td>' + dadosHistorico.unidadeResponsavel + '</td>' +
                        '<td>' + dadosHistorico.observacaoHistorico + '</td>' +
                    '</tr>';
            return linha;
        }

        $('#codigoDemanda').val(dados.codigoDemanda);
        $('#nomeCliente').val(dados.nomeCliente);
        $('#cnpj').val(dados.cnpj.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, "$1.$2.$3/$4-$5"));
        $('#status').val(dados.status);
        $('#contratoCaixa').val(dados.contratoCaixa);
        $('#contratoBndes').val(dados.contratoBndes);
        $('#contaDebito').val(dados.contaDebito);
        $('#tipoOperacao').val(dados.tipoOperacao);
        $('#valorOperacao').val(dados.valorOperacao);
        $('#codigoPa').val(dados.codigoPa);
        $('#codigoSr').val(dados.codigoSr);
        $('#codigoGigad').val(dados.codigoGigad);
    });
}