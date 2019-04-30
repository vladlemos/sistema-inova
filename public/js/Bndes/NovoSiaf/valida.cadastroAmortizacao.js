 //função para validar os campo do formulário antes de efetuar o envio para o banco
 function validaCadastroAmortizacao(){

    if ($("#valorAmort"+[i]).val() !== ""){

        $("#valorAmort"+[i]).attr(required="required");
        $("#contaDebito"+[i]).attr(required="required");
        $("#tipoAmort"+[i]).attr(required="required");
        $("#ctrBndes"+[i]).attr(required="required");

        alert("Para solicitar a amortização é necessário preencher os campos Contrato BNDES, Contrato Caixa, Conta Caixa, Valor e Tipo de comando.");

        // //valida o valor
        // function validaValorAmortizacao(){

        //     if ($("#valorAmort"+[i]).val() !== ""){
        //         return true;
        //     }
        //     else{
        //         return false;
        //     }
        // }
        // //valida o contrato
        // function validaContratoBndes(){

        //     if ($("#ctrBndes"+[i]).val() !== "" || $("#ctrBndes"+[i]).val() !== "null" || $("#ctrBndes"+[i]).val() !== null) {
        //         return true;
        //     }
        //     else{
        //         return false;
        //     }
        // }
        // //valida a conta
        // function validaContaDebito(){

        //     if($("#contaDebito"+[i]).val() !== ""){
        //         return true;
        //     }
        //     else{
        //         return false;
        //     }
        // }
        // //valida o tipo de comando
        // function validaTipoComando(){

        //     if($("#tipoAmort"+[i]).val() !== null){
        //         return true;
        //     }
        //     else{
        //         return false;
        //     }
        // }
        // //se todos os campo retornam true continua a função na pagina dados.contratos.ag
        // if (validaValorAmortizacao() == true && validaContratoBndes() == true && validaContaDebito() == true && validaTipoComando() == true){
        //     return true;
        }
        else{
            
            $("#valorAmort"+[i]).attr(required="");
            $("#contaDebito"+[i]).attr(required="");
            $("#tipoAmort"+[i]).attr(required="");
            $("#ctrBndes"+[i]).attr(required="");

            return true;
        }

    }
   
// }