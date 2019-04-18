
$( document ).ready(function() {
    consumoJsonMultinivel();
});

function consumoJsonMultinivel(){
    $.get( "/dados.json", function( dados ) {
        for(i = 0; i < dados.consultaSaldo.length; i++){
            // console.log(json[i]);
            linha = montaLinhaTabelaSaldo(dados.consultaSaldo[i]);
            $('#tabelaConsultaSaldo>tbody').append(linha);
        }              
        function montaLinhaTabelaSaldo(dadosSaldo)
        {
            linha = '<tr>' +
                        '<td>' + dadosSaldo.dataConsultaSaldo.date.toLocaleString() + '</td>' +
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
            // console.log(json[i]);
            linha = montaLinhaTabelaHistorico(dados.historicoContrato[i]);
            $('#tabelaHistoricoContrato>tbody').append(linha);
        }              
        function montaLinhaTabelaHistorico(dadosHistorico)
        {
            linha = '<tr>' +
                        '<td>' + dadosHistorico.dataHistorico.date.toLocaleString() + '</td>' +
                        '<td>' + dadosHistorico.statusHistorico + '</td>' +
                        '<td>' + dadosHistorico.matriculaResponsavel + '</td>' +
                        '<td>' + dadosHistorico.unidadeResponsavel + '</td>' +
                        '<td>' + dadosHistorico.observacaoHistorico + '</td>' +
                    '</tr>';
            return linha;
        }

        codigoDemanda = dados.codigoDemanda;
        nomeCliente = dados.nomeCliente;
        cnpj = dados.cnpj.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, "$1.$2.$3/$4-$5");
        status = dados.status;
        contratoCaixa = dados.contratoCaixa;
        contratoBndes = dados.contratoBndes;
        contaDebito = dados.contaDebito;
        tipoOperacao = dados.tipoOperacao;
        valorOperacao = dados.valorOperacao;
        codigoPa = dados.codigoPa;
        codigoSr = dados.codigoSr;
        codigoGigad = dados.codigoGigad;

        document.getElementById('codigoDemanda').value = codigoDemanda;
        document.getElementById('nomeCliente').value = nomeCliente;
        document.getElementById('cnpj').value = cnpj;
        document.getElementById('status').value = status;
        document.getElementById('contratoCaixa').value = contratoCaixa;
        document.getElementById('contratoBndes').value = contratoBndes;
        document.getElementById('contaDebito').value = contaDebito;
        document.getElementById('tipoOperacao').value = tipoOperacao;
        document.getElementById('valorOperacao').value = valorOperacao;
        document.getElementById('codigoPa').value = codigoPa;
        document.getElementById('codigoSr').value = codigoSr;
        document.getElementById('codigoGigad').value = codigoGigad;

        // console.log(dados);
    });
}