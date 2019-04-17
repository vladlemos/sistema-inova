
$( document ).ready(function() {
    consumoJsonMultinivel();
});

function consumoJsonMultinivel(){
    // $.ajax({
    //     type: 'GET',
    //     url: '/api/bndes/v2/siaf_amortizacoes/3000',
    //     context: this,
    //     data: dados,
    //     success: function(dados){
    //         console.log(dados);
    //     },
    //     error: function(error){
    //         console.log(error);
    //     }
    // });
    $.get( "https://inova.ceopc.des.caixa/sistemas/public/api/bndes/v2/siaf_amortizacoes/3000", function( dados ) {
        var jsonObjeto = jQuery.parseJSON(dados);
        // // var jsonSaldo = jQuery.parseJSON(consultaSaldo);
        // for(i = 0; i < jsonObjeto.consultaSaldo.length; i++){
            
        //         dataConsultaSaldo = jsonObjeto.consultaSaldo[i].dataConsultaSaldo.date,
                 
            
        //     console.log(dataConsultaSaldo);
        // }
        // console.log(jsonObjeto);
        // // console.log(jsonSaldo);

        // codigoDemanda = jsonObjeto.codigoDemanda;
        // nomeCliente = jsonObjeto.nomeCliente;
        // cnpj = jsonObjeto.cnpj;
        // status = jsonObjeto.status;
        // contratoCaixa = jsonObjeto.contratoCaixa;
        // contratoBndes = jsonObjeto.contratoBndes;
        // contaDebito = jsonObjeto.contaDebito;
        // tipoOperacao = jsonObjeto.tipoOperacao;
        // valorOperacao = jsonObjeto.valorOperacao;
        // codigoPa = jsonObjeto.codigoPa;
        // codigoSr = jsonObjeto.codigoSr;
        // codigoGigad = jsonObjeto.codigoGigad;
        
        var objectKeys = Object.keys(jsonObjeto);
        console.log(‘objectKeys: ‘, objectKeys);
 
        
    });
}