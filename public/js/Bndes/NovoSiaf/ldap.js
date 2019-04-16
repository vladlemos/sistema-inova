$(document).ready(function(){
   
    carregaDadosEmpregado();
    

 });

//  carrega os dados da pessoa logada na sessão

function carregaDadosEmpregado(json){
    var url = ('../api/sistemas/v1/dados_empregado')
    
  $.ajax({
      
      type: 'GET',
      url : url,
      
           success: function(carregaEmpregado){
         
            
          var empregado = JSON.parse(carregaEmpregado);
          
          $.each(empregado, function(key, value){

// verificao perfil e desabilita a aba da agência caso perfil CEOPC
          
            if(value.codigoLotacaoFisica !== null){
                
                $(".perfilVisualizacao").html('Pedidos da unidade : ' + value.nomeLotacaoFisica);
                $("#nomeEmpregado").html(value.nomeCompleto);
                $("#nomeSessao").html(value.nomeCompleto);
                $("#matriculaSessao").html(value.matricula);
                $("#funcaoSessao").html(value.nomeFuncao);
                $("#lotacaoSessao").html(value.codigoLotacaoFisica);
                $("#perfilSessao").html(value.nivelAcesso);  
                $("#nomeSessaoBemVindo").html(value.nomeCompleto);  
                $("#agenciaContrato").html(value.nomeLotacaoFisica);
                // $("#abaContratosLiquidar").hide();
               
            }

        

            else{
            
                $(".perfilVisualizacao").html('Pedidos da unidade : ' + value.nomeLotacaoAdministrativa);
                $("#nomeEmpregado").html(value.nomeCompleto);
                $("#nomeSessao").html(value.nomeCompleto);
                $("#matriculaSessao").html(value.matricula);
                $("#funcaoSessao").html(value.nomeFuncao);
                $("#lotacaoSessao").html(value.codigoLotacaoAdministrativa);
                $("#perfilSessao").html(value.nivelAcesso);  
                $("#nomeSessaoBemVindo").html(value.nomeCompleto);  
                $("#agenciaContrato").html(value.nomeLotacaoAdministrativa);
                // $("#abaContratosLiquidar").hide();
            
            }

            if(value.nivelAcesso == 'CEOPC'){
                
                $("ul.nav-tabs li").removeClass("active");  
                $("#abaContratosLiquidar").hide();
                $("#contratosliquidar").hide();
                $("#abaAmortizaprox").addClass("active").show(); 
                $("#amortizaprox").show();
                $(".perfilVisualizacao").html('Visualizando Todos Pedidos');
            }
          });

          
       
      }
    
  });  
}
