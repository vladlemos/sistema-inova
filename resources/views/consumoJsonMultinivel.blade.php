<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Consumo Json Multinivel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        NOME: <input class="form-control" type="text" id="nomeCliente" value="" readonly="readonly"/><br/>
        CNPJ: <input class="form-control" type="text" id="cnpj" value="" readonly="readonly"/><br/>
        DEMANDA: <input class="form-control" type="text" id="codigoDemanda" value="" readonly="readonly"/><br/>
        CONTRATO BNDES: <input class="form-control" type="text" id="contratoBndes" value="" readonly="readonly"/><br/>
        CONTRATO CAIXA: <input class="form-control" type="text" id="contratoCaixa" value="" readonly="readonly"/><br/>
        CONTA DEBITO: <input class="form-control" type="text" id="contaDebito" value="" readonly="readonly"/><br/>
        VALOR OPERACAO: <input class="form-control" type="text" id="valorOperacao" value="" readonly="readonly"/><br/>
        TIPO OPERACAO: <input class="form-control" type="text" id="tipoOperacao" value="" readonly="readonly"/><br/>
        STATUS: <input class="form-control" type="text" id="status" value="" readonly="readonly"/><br/>
        CODIGO PA: <input class="form-control" type="text" id="codigoPa" value="" readonly="readonly"/><br/>
        CODIGO SR: <input class="form-control" type="text" id="codigoSr" value="" readonly="readonly"/><br/>
        CODIGO GIGAD: <input class="form-control" type="text" id="codigoGigad" value="" readonly="readonly"/><br/>

        <table class="table table-ordered table-hover table-striped" id='tabelaConsultaSaldo'>
            <thead>
                <tr>
                    <th>ID CONSULTA</th>
                    <th>DATA CONSULTA SALDO</th>
                    <th>STATUS SALDO</th>
                    <th>SALDO DISPONIVEL</th>
                    <th>SALDO BLOQUEADO</th>
                    <th>LIMITE CHEQUE AZUL</th>
                    <th>LIMITE GIM</th>
                    <th>SALDO TOTAL</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table> 

        <table class="table table-ordered table-hover table-striped" id='tabelaHistoricoContrato'>
            <thead>
                <tr>
                    <th>ID HISTORICO</th>
                    <th>DATA HISTORICO</th>
                    <th>STATUS HISTORICO</th>
                    <th>MATRICULA RESPONSAVEL</th>
                    <th>UNIDADE RESPONSAVEL</th>
                    <th>OBSERVACAO HISTORICO</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table> 
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/consumoJsonMultinivel.js')}}"></script>
</body>
</html>