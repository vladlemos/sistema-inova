$(document).ready(function(){
   
    carregaDadosEmpregado();
    

 });

//  carrega dos dados da pessoa logada na sessão

function carregaDadosEmpregado(json){
    var url = ('../api/dados_empregado')
    
  $.ajax({
      
      type: 'GET',
      url : url,
      
           success: function(carregaEmpregado){
         
            
          var empregado = JSON.parse(carregaEmpregado);
          
          $.each(empregado, function(key, value){

// verificao perfil e desabilita a aba da agência caso perfil CEOPC
            if(value.nivel_acesso == 'CEOPC'){

                $("ul.nav-tabs li").removeClass("active");  
                $("#abaContratosLiquidar").hide();
                $("#contratosliquidar").hide();
                $("#abaAmortizaprox").addClass("active").show(); 
                $("#amortizaprox").show();
            }

            if(value.codigo_lotacao_fisica !== null){
                
                $("#nomeEmpregado").html(value.nome_completo);
                $("#nomeSessao").html(value.nome_completo);
                $("#matriculaSessao").html(value.matricula);
                $("#funcaoSessao").html(value.nome_funcao);
                $("#lotacaoSessao").html(value.codigo_lotacao_fisica);
                $("#perfilSessao").html(value.nivel_acesso);  
                $("#nomeSessaoBemVindo").html(value.nome_completo);  
                $("#agenciaContrato").html(value.nome_lotacao_fisica);
               
            }
            else{
            
                $("#nomeEmpregado").html(value.nome_completo);
                $("#nomeSessao").html(value.nome_completo);
                $("#matriculaSessao").html(value.matricula);
                $("#funcaoSessao").html(value.nome_funcao);
                $("#lotacaoSessao").html(value.codigo_lotacao_administrativa);
                $("#perfilSessao").html(value.nivel_acesso);  
                $("#nomeSessaoBemVindo").html(value.nome_completo);  
                $("#agenciaContrato").html(value.nome_lotacao_administrativa);
            
            }
          });
       
      }
    
  });  
}
