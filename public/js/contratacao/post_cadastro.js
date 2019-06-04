// function postCadastro()
// tipoOperacao = $('#tipoOperacao').val();
// {
//     submit = {
//         cpf: $('#cpf').val(),
//         cnpj: $('#cnpj').val(),
//         nomeCliente: $('#nomeCliente').val(),
//         tipoOperacao: $('#tipoOperacao').val(),
//         tipoMoeda: $('#tipoMoeda').val(),
//         valorOperacao: $('#valorOperacao').val(),
//         dataPrevistaEmbarque: $('#dataPrevistaEmbarque').val(),
//         responsavelAtual: $('#matricula').val(),

// function postCadastro() 
// tipoOperacao = $('#tipoOperacao').val()
// $('#tipoOperacao').change(function trocaTipoOperacao()
// {
    
    
$(document).ready(function() {

//Declaração de variáveis dos inputs de arquivos, para carregar múltiplos como array.
    var invoiceImpAnt = [];
    var dadosImpAnt = [];
    var autSrImpAnt = [];

    var invoiceImp = [];
    var embarqueImp = [];
    var di = [];
    var dadosImp = [];
    var autSrImp = [];

    var invoiceExpAnt = [];
    var autSrExpAnt = [];
   
    var invoiceExp = [];
    var embarqueExp = [];
    var due = [];
    var autSrExp = [];





    $('input[name="temContaBeneficiarioAntecipado"]').click(function() {
        if ($('#temContaBeneficiarioAntecipadoSim').is(':checked')) {
        $('#dadosImpAnt').attr('required', true);
        }
        else {
        $('#dadosImpAnt').attr('required', false);
        }
    });
    $('input[name="temContaBeneficiarioNormal"]').click(function() {
        if ($('#temContaBeneficiarioNormalSim').is(':checked')) {
        $('#dadosImp').attr('required', true);
        }
        else{
        $('#dadosImp').attr('required', false);
        }
    
});

    $('input[type="file"]').change(function () {
        var ext = this.value.split('.').pop().toLowerCase();
        switch (ext) {
            case 'jpg':
            case 'jpeg':
            case 'png':
            case 'pdf':
                $('#submitBtn').attr('disabled', false);
                
                break;
            default:
                $('#submitBtn').attr('disabled', true);
                alert('O tipo de arquivo selecionado não é aceito. Favor carregar um arquivo de imagem ou PDF.');
                this.value = '';
        }
    });

    $("#formTipoOperacao").submit(function postCadastro() {

    tipoOperacao = $('#tipoOperacao').val();
    switch (tipoOperacao) {

    case '1':

    alert = "Nenhuma operação foi selecionada.";

    break;

    case '2': //-Tipo 2 é Pronto Importação Antecipado

    submit = {
        cpf: $('#cpf').val(),
        cnpj: $('#cnpj').val(),
        nomeCliente: $('#nomeCliente').val(),
        tipoOperacao: $('#tipoOperacao').val(),
        tipoMoeda: $('#tipoMoeda').val(),
        valorOperacao: $('#valorOperacao').val(),
        dataPrevistaEmbarque: $('#dataPrevistaEmbarque').val(),
        responsavelAtual: $('#matricula').val(),

        //-puxa dados bancarios beneficiário Antecipado
        nomeBeneficiario: $('#nomeBeneficiarioAnt').val(),
        nomeBanco: $('#nomeBancoAnt').val(),
        iban: $('#ibanAnt').val(),
        AgContaBeneficiario: $('#AgContaBeneficiarioAnt').val(),
        //
        //-puxa arquivos de Pronto Importação Antecipado
        invoiceImpAnt: $('#invoiceImpAnt').map(function(){return $(this).val();}).get(),
        dadosImpAnt: $('#dadosImpAnt').map(function(){return $(this).val();}).get(),
        autSrImpAnt: $('#autSrImpAnt').map(function(){return $(this).val();}).get(),
        //
        } //- Fecha submit case 2

        break;

    case '3': //-Tipo 3 é Pronto Importação

    submit = {
        cpf: $('#cpf').val(),
        cnpj: $('#cnpj').val(),
        nomeCliente: $('#nomeCliente').val(),
        tipoOperacao: $('#tipoOperacao').val(),
        tipoMoeda: $('#tipoMoeda').val(),
        valorOperacao: $('#valorOperacao').val(),
        dataPrevistaEmbarque: $('#dataPrevistaEmbarque').val(),
        responsavelAtual: $('#matricula').val(),


        //-puxa dados bancarios beneficiário 
        nomeBeneficiario: $('#nomeBeneficiario').val(),
        nomeBanco: $('#nomeBanco').val(),
        iban: $('#iban').val(),
        AgContaBeneficiario: $('#AgContaBeneficiario').val(),
        //        

        //-puxa arquivos de Pronto Importação
        invoiceImp: $('#invoiceImp').val(),
        embarqueImp: $('#embarqueImp').val(),
        di: $('#di').val(),
        dadosImp: $('#dadosImp').val(),
        autSrImp: $('#autSrImp').val(),
        //
        }//- Fecha submit case 3

        break;

    case '4': //-Tipo 3 é Pronto Exportação Antecipado

    submit = {
        cpf: $('#cpf').val(),
        cnpj: $('#cnpj').val(),
        nomeCliente: $('#nomeCliente').val(),
        tipoOperacao: $('#tipoOperacao').val(),
        tipoMoeda: $('#tipoMoeda').val(),
        valorOperacao: $('#valorOperacao').val(),
        dataPrevistaEmbarque: $('#dataPrevistaEmbarque').val(),
        responsavelAtual: $('#matricula').val(),

        //-puxa arquivos de Pronto Exportação Antecipado
        invoiceExpAnt: $('#invoiceExpAnt').val(),
        autSrExpAnt: $('#autSrExpAnt').val(),
        //
        }//- Fecha submit case 4

        break;

    case '5': //-Tipo 3 é Pronto Exportação

    submit = {
        cpf: $('#cpf').val(),
        cnpj: $('#cnpj').val(),
        nomeCliente: $('#nomeCliente').val(),
        tipoOperacao: $('#tipoOperacao').val(),
        tipoMoeda: $('#tipoMoeda').val(),
        valorOperacao: $('#valorOperacao').val(),
        dataPrevistaEmbarque: $('#dataPrevistaEmbarque').val(),
        responsavelAtual: $('#matricula').val(),

        //-puxa arquivos de Pronto Exportação
        invoiceExp: $('#invoiceExp').val(),
        embarqueExp: $('#embarqueExp').val(),
        due: $('#due').val(),
        autSrExp: $('#autSrExp').val(),
        //
        } // fecha submit case 5

}; // fecha switch


// $('#upload').on('click', function () {
// });


$.post('backend/post_teste.php', submit, function(postCadastro){
    // submit = JSON.parse(postCadastro);
    console.log (submit);
    alert("Demanda cadastrada com sucesso.");
});


    // var form_data = new FormData();
    // var ins = document.getElementById('multiFiles').files.length;
    // for (var x = 0; x < ins; x++) {
    //     form_data.append("files[]", document.getElementById('multiFiles').files[x]);
    // }
    // $.ajax({
    //     url: '/backend/post_teste.php', // point to server-side PHP script 
    //     dataType: 'text', // what to expect back from the PHP script
    //     cache: false,
    //     contentType: false,
    //     processData: false,
    //     data: form_data,
    //     type: 'post',
    //     success: function (response) {
    //         $('#msg').html(response); // display success response from the PHP script
    //     },
    //     error: function (response) {
    //         $('#msg').html(response); // display error response from the PHP script
    //     }
    // });






// $.each($('input[type="file"]').lenght, function(i=0, value) {

    
// var filename = this.value;
// console.log(filename);
// var valid_extensions = /(\.jpg|\.jpeg|\.gif)$/i;   
// if(valid_extensions.test(filename))
// {

// }
// else
// {
//    alert('O tipo de arquivo selecionado não é aceito. Favor carregar um arquivo de imagem ou PDF.');
// }
// });


    // linha = montaLinhaTabelaProdutos(produto);
    // $('#tabelaProdutos>tbody').append(linha);
    



}); // fecha função postCadastro


}); // fecha document ready
