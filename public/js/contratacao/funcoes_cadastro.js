// ####################### MARCARA DE DATA, CPF, CNPJ e dinheiro #######################

$(document).ready(function(){
    $('.mascaradinheiro').mask('000.000.000.000.000,00' , { reverse : true});
    $('.mascaradata').mask('00/00/0000');
    $('.mascaracpf').mask('000.000.000-00');
    $('.mascaracnpj').mask('00.000.000/0000-00');
});

// ####################### FUNÇÃO QUE ZERA O VALOR DE CPF E CNPJ QUANDO O OUTRO FOR SELECIONADO #######################

$(function() {
    $('#radioCpf').click(function() {
        $('#radioCnpj').removeAttr('checked');
        $('#cnpj').val('');
        $('#cpfCnpj2').show();
        $('#cpfCnpj3').hide();
    });
    $('#radioCnpj').click(function() {
        $('#radioCpf').removeAttr('checked');
        $('#cpf').val('');
        $('#cpfCnpj2').hide();
        $('#cpfCnpj3').show();
    });

});

// ####################### FUNÇÃO QUE MOSTRA DOCUMENTACAO DEPENDENDO DA OPERACAO SELECIONADA #######################
// ####################### FUNÇÃO DE REQUIRED NOS ARQUIVOS #######################
$(document).ready(function() {
    $('#tipoOperacao').on('change',function(){
        
    // var val = parseInt($(this).val(), 10);

        switch($('#tipoOperacao option:selected').val()) {

            case "1": //-Tipo 1 é Nenhum

            $('input[type="file"]').val('');

            $('#divRadioDadosBancarios').hide();
            $('#temDadosBancariosSim').attr('checked', false);
            $('#temDadosBancariosNao').attr('checked', false);
            $('input.iban[type=text]').val('');
           
            $('#divInvoice').hide();
            $('#divConhecimento').hide();
            $('#divDi').hide();
            $('#divDue').hide();
            $('#divAutorizacao').hide();

            break;
            
            case "2": //-Tipo 2 é Pronto Importação Antecipado

            $('input[type="file"]').val('');

            $('#divRadioDadosBancarios').show();
            $('#temDadosBancariosSim').attr('checked', false);
            $('#temDadosBancariosNao').attr('checked', false);
            $('input.iban[type=text]').val('');

            $('#uploadInvoice').attr('required', true);
            $('#divInvoice').show();
            $('#uploadConhecimento').attr('required', false);
            $('#divConhecimento').hide();
            $('#uploadDi').attr('required', false);
            $('#divDi').hide();
            $('#uploadDue').attr('required', false);
            $('#divDue').hide();
            $('#uploadAutorizacaoSr').attr('required', true);
            $('#divAutorizacao').show();
    
            break;

            case "3": //-Tipo 3 é Pronto Importação
            
            $('input[type="file"]').val('');

            $('#divRadioDadosBancarios').show();
            $('#temDadosBancariosSim').attr('checked', false);
            $('#temDadosBancariosNao').attr('checked', false);
            $('input.iban[type=text]').val('');

            $('#uploadInvoice').attr('required', true);
            $('#divInvoice').show();
            $('#uploadConhecimento').attr('required', true);
            $('#divConhecimento').show();
            $('#uploadDi').attr('required', true);
            $('#divDi').show();
            $('#uploadDue').attr('required', false);
            $('#divDue').hide();
            $('#uploadAutorizacaoSr').attr('required', true);
            $('#divAutorizacao').show();

            break;

            case "4": //-Tipo 4 é Pronto Exportação Antecipado

            $('input[type="file"]').val('');

            $('#divRadioDadosBancarios').hide();
            $('#temDadosBancariosSim').attr('checked', false);
            $('#temDadosBancariosNao').attr('checked', false);
            $('input.iban[type=text]').val('');

            $('#uploadInvoice').attr('required', true);
            $('#divInvoice').show();
            $('#uploadConhecimento').attr('required', false);
            $('#divConhecimento').hide();
            $('#uploadDi').attr('required', false);
            $('#divDi').hide();
            $('#uploadDue').attr('required', false);
            $('#divDue').hide();
            $('#uploadAutorizacaoSr').attr('required', true);
            $('#divAutorizacao').show();
     
        
            break;

            case "5": //-Tipo 5 é Pronto Exportação

            $('input[type="file"]').val('');

            $('#divRadioDadosBancarios').hide();
            $('#temDadosBancariosSim').attr('checked', false);
            $('#temDadosBancariosNao').attr('checked', false);
            $('input.iban[type=text]').val('');

            $('#uploadInvoice').attr('required', true);
            $('#divInvoice').show();
            $('#uploadConhecimento').attr('required', true);
            $('#divConhecimento').show();
            $('#uploadDi').attr('required', false);
            $('#divDi').hide();
            $('#uploadDue').attr('required', true);
            $('#divDue').show();
            $('#uploadAutorizacaoSr').attr('required', true);
            $('#divAutorizacao').show();

        } // fecha switch
    });
});


// FAZER AQUI UMA FUNC QUE DA HIDE / SHOW E REQUIRED NOS DADOS BANCARIOS
// $('#uploadDadosBancarios').attr('required', false);


// ####################### FUNÇÃO QUE ESCONDE CAMPO IBAN DEPENDENDO DO SELECIONADO #######################


$(document).ready(function() {
    $("input[name$='temDadosBancarios']").click(function() {
        var test = $(this).val();

        $("div.desc2").hide();
        $("#divInformaDadosBancarios" + test).show();

        if ($('#temDadosBancariosSim').is(':checked')) {
            $('#divDados').show();
            $('#uploadDadosBancarios').attr('required', true);
        }
        else {
            $('#divDados').hide();
            $('#uploadDadosBancarios').attr('required', false);
        }
    
    });
});

// ####################### NÃO TESTADO - FUNÇÃO QUE PROIBE DAR SUBMIT COM O CAMPO MODALIDADE VAZIO #######################


$('#formCadastroContratacao').submit(function(e) {
    e.preventDefault();
    $("#tipoOperacao").each(function(){
        if($.trim(this.value) == ""){
            alert('you did not fill out one of the fields');
        } else {
            // Submit
        }
    })
})

// ####################### FUNÇÃO DE ANIMAÇÃO DO BOTÃO UPLOAD #######################

$(function() {

    // We can attach the `fileselect` event to all file inputs on the page
    $(document).on('change', ':file', function() {
      var input = $(this),
          numFiles = input.get(0).files ? input.get(0).files.length : 1,
          label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
      input.trigger('fileselect', [numFiles, label]);
    });
  
    // We can watch for our custom `fileselect` event like this
    $(document).ready( function() {
        $(':file').on('fileselect', function(event, numFiles, label) {
  
            var input = $(this).parents('.input-group').find(':text'),
                log = numFiles > 1 ? numFiles + ' files selected' : label;
  
            if( input.length ) {
                input.val(log);
            } else {
                if( log ) alert(log);
            }
  
        });
    });
    
  });



  




