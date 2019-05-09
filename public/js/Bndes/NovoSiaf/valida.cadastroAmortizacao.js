 //função para validar os campo do formulário antes de efetuar o envio para o banco
 function validaCadastroAmortizacao(){
    // var pedidos = $('#tabCadastrar>tbody>tr').length;
    // i=0;
   
    
    // for(i; i < pedidos; i++) {

        if ($("#valorAmort"+[i]).val() !== ""){

            $("#valorAmort"+[i]).attr("required", true);
            $("#contaDebito"+[i]).attr("required", true);
            $("#tipoAmort"+[i]).attr("required", true);
            $("#ctrBndes"+[i]).attr("required", true);

        
        }
         
        else{
            
            $("#valorAmort"+[i]).attr("required", false);
            $("#contaDebito"+[i]).attr("required", false);
            $("#tipoAmort"+[i]).attr("required", false);
            $("#ctrBndes"+[i]).attr("required", false);

        //    return(false);
        }

    }
 
// }

    function check_form(){
        formulario = $('#tabCadastrar');
        // formulario.validate();

        if(formulario.valid()){
            return true;
        }
        else{
            return false;
        }
    console.log(formulario);
    }

    //     var inputs = document.getElementsByClassName('required');
    //     var len = inputs.length;
    //     var valid = true;
    //   for(var i=0; i < len; i++){
     
    //     if (!valid){
    //         //   alert('Por favor preencha todos os campos.');
    //         return false;
    //     } 
    //     else { 
    //         return true; 
    //     }
    // }
    // console.log(len);
// }
