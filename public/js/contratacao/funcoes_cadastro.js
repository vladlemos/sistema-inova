// ####################### MARCARA DE DATA, CPF, CNPJ e dinheiro #######################

$(document).ready(function(){
    $('.mascaradinheiro').mask('000.000.000.000.000,00' , { reverse : true});
    $('.mascaradata').mask('00/00/0000');
    $('.mascaracpf').mask('000.000.000-00');
    $('.mascaracnpj').mask('00.000.000/0000-00');
});



// ####################### FUNÇÃO QUE MOSTRA CAMPO CPF OU CNPJ DEPENDENDO DO SELECIONADO #######################

$(document).ready(function() {
    $("input[name$='escolheTipoPessoa']").click(function() {
        var test = $(this).val();

        $("div.desc").hide();
        $("#cpfCnpj" + test).show();
    });
});

// ####################### FUNÇÃO QUE MOSTRA DOCUMENTACAO DEPENDENDO DA OPERACAO SELECIONADA #######################

$(function() {
    $('#tipoOperacao').change(function(){
        $('.desc3').hide();
        $('#' + $(this).val()).show();

    tipoOperacao = $('#tipoOperacao').val();
        switch (tipoOperacao) {

            case '2': //-Tipo 2 é Pronto Importação Antecipado

            $('#invoiceImpAnt').attr('required', true);
            $('#autSrImpAnt').attr('required', true);
    
            $('#invoiceImp').attr('required', false);
            $('#invoiceImp').val('');
            // this.value = '';
            $('#embarqueImp').attr('required', false);
            $('#embarqueImp').val('');
            $('#di').attr('required', false);
            $('#di').val('');
            $('#autSrImp').attr('required', false);
            $('#autSrImp').val('');
    
            $('#invoiceExpAnt').attr('required', false);
            $('#invoiceExpAnt').val('');
            $('#autSrExpAnt').attr('required', false);
            $('#autSrExpAnt').val('');

            $('#invoiceExp').attr('required', false);
            $('#invoiceExp').val('');
            $('#embarqueExp').attr('required', false);
            $('#embarqueExp').val('');
            $('#due').attr('required', false);
            $('#due').val('');
            $('#autSrExp').attr('required', false);
            $('#autSrExp').val('');      
    
            break;

            case '3': //-Tipo 3 é Pronto Importação
            
            $('#invoiceImpAnt').attr('required', false);
            $('#invoiceImpAnt').val('');
            $('#autSrImpAnt').attr('required', false);
            $('#autSrImpAnt').val('');

            $('#invoiceImp').attr('required', true);
            $('#embarqueImp').attr('required', true);
            $('#di').attr('required', true);
            $('#autSrImp').attr('required', true);

            $('#invoiceExpAnt').attr('required', false);
            $('#invoiceExpAnt').val('');
            $('#autSrExpAnt').attr('required', false);
            $('#autSrExpAnt').val('');

            $('#invoiceExp').attr('required', false);
            $('#invoiceExp').val('');
            $('#embarqueExp').attr('required', false);
            $('#embarqueExp').val('');
            $('#due').attr('required', false);
            $('#due').val('');
            $('#autSrExp').attr('required', false);      
            $('#autSrExp').val('');      

            break;

            case '4': //-Tipo 3 é Pronto Exportação Antecipado

            $('#invoiceImpAnt').attr('required', false);
            $('#invoiceImpAnt').val('');
            $('#autSrImpAnt').attr('required', false);
            $('#autSrImpAnt').val('');
        
            $('#invoiceImp').attr('required', false);
            $('#invoiceImp').val('');
            $('#embarqueImp').attr('required', false);
            $('#embarqueImp').val('');
            $('#di').attr('required', false);
            $('#di').val('');
            $('#autSrImp').attr('required', false);
            $('#autSrImp').val('');
        
            $('#invoiceExpAnt').attr('required', true);
            $('#autSrExpAnt').attr('required', true);
        
            $('#invoiceExp').attr('required', false);
            $('#invoiceExp').val('');
            $('#embarqueExp').attr('required', false);
            $('#embarqueExp').val('');
            $('#due').attr('required', false);
            $('#due').val('');
            $('#autSrExp').attr('required', false);
            $('#autSrExp').val('');
     
        
            break;

            case '5': //-Tipo 3 é Pronto Exportação

            $('#invoiceImpAnt').attr('required', false);
            $('#invoiceImpAnt').val('');
            $('#autSrImpAnt').attr('required', false);
            $('#autSrImpAnt').val('');

            $('#invoiceImp').attr('required', false);
            $('#invoiceImp').val('');
            $('#embarqueImp').attr('required', false);
            $('#embarqueImp').val('');
            $('#di').attr('required', false);
            $('#di').val('');
            $('#autSrImp').attr('required', false);
            $('#autSrImp').val('');

            $('#invoiceExpAnt').attr('required', false);
            $('#invoiceExpAnt').val('');
            $('#autSrExpAnt').attr('required', false);
            $('#autSrExpAnt').val('');

            $('#invoiceExp').attr('required', true);
            $('#embarqueExp').attr('required', true);
            $('#due').attr('required', true);
            $('#autSrExp').attr('required', true);      

        }; // fecha switch

    });
});


// $(document).ready(function() {
//     $("option[id$='tipoOperacao']").click(function() {
//         var test = $(this).val();

//         $("div.desc3").hide();
//         $("#tipoOperacao" + test).show();
//     });
// });

// ####################### FUNÇÃO QUE ESCONDE CAMPO IBAN DEPENDENDO DO SELECIONADO #######################


$(document).ready(function() {
    $("input[name$='temContaBeneficiarioAntecipado']").click(function() {
        var test = $(this).val();

        $("div.desc2").hide();
        $("#contaBeneficiarioAntecipado" + test).show();
    });
});

$(document).ready(function() {
  $("input[name$='temContaBeneficiarioNormal']").click(function() {
      var test = $(this).val();

      $("div.desc2").hide();
      $("#contaBeneficiarioNormal" + test).show();
  });
});


// ####################### NÃO TESTADO - FUNÇÃO QUE PROIBE DAR SUBMIT COM O CAMPO MODALIDADE VAZIO #######################


$('#formTipoOperacao').submit(function(e) {
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


// ####################### FUNÇÃO DE REQUIRED NOS ARQUIVOS #######################

  




