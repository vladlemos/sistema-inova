function idTabela(){
// tab= $("#abasDasTabelas");
nomeBotao = $('#abasDasTabelas .active').attr('id');

switch(nomeBotao){
 
    case "abaLoteAtual":
    idTabelaDataTable = "tabelaLoteAtual";
    // retornoIdTabela = "tabelaLoteAtual";
    break;
    case "abaAmortizaant":
    idTabelaDataTable = "tabelaLoteAnterior";
    // retornoIdTabela = "tabelaLoteAnterior";
    break;
    case "abaSUMEP":
    idTabelaDataTable = "tabelaSumep";
    // retornoIdTabela = "tabelaSumep";
    break;
   

}
return idTabelaDataTable;
// console.log ('oi : '+   idTabelaDataTable);
}