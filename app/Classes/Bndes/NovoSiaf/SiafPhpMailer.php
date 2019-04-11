<?php

namespace App\Classes\Bndes\NovoSiaf;

// use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class SiafPhpMailer
{
    function enviarMensageria($objEmpregado, $objContratos, $tipoEmail){
        $mail = new PHPMailer(true);
        $this->carregarDadosEmail($objEmpregado, $mail);
        $this->carregarConteudoEmail($objEmpregado, $objContratos, $mail, $tipoEmail);
        $this->enviarEmail($mail);
    }
    
    function carregarDadosEmail($objEmpregado, $mail){
        //Server settings
        $mail->isSMTP();  
        $mail->CharSet = 'UTF-8';                                          
        $mail->Host = 'sistemas.correiolivre.caixa';  
        $mail->SMTPAuth = false;                                  
        $mail->Port = 25;                                    

        //Recipients
        $mail->setFrom('ceopc08@caixa.gov.br', 'CAIXA - ROTINAS AUTOMATICAS');
        $mail->addAddress('c111710@mail.caixa');     // Add a recipient
        // $mail->addAddress('ellen@example.com');               // Name is optional
        // $mail->addReplyTo('info@example.com', 'Information');
        // $mail->addCC('c079436@mail.caixa');
        // $mail->addBCC('c095060@mail.caixa');
        return $mail; 
    }

    function carregarConteudoEmail($objEmpregado, $objContratos, $mail, $etapaDoProcesso){
        switch ($etapaDoProcesso) {
            case 'registroNovaDemanda':
                return $this->registroNovaDemanda($objEmpregado, $objContratos, $mail);
            break;
            case 'pendenciaContaDivergente':
                return $this->pendenciaContaDivergente($objEmpregado, $objContratos, $mail);
            break;
            case 'pendenciaValorDivergenteSiafSiban':
                return $this->pendenciaValorDivergenteSiafSiban($objEmpregado, $objContratos, $mail);
            break;
            case 'pendenciaSolicitacaoComContaPessoaFisica':
                return $this->pendenciaSolicitacaoComContaPessoaFisica($objEmpregado, $objContratos, $mail);
            break;
            
    
        }
    }

    function enviarEmail($mail) {
        try {
            $mail->send();
            echo 'Mensagem enviada com sucesso';
        } catch (Exception $e) {
            echo "Mensagem não pode ser enviada. Erro: {$mail->ErrorInfo}";
        }
    }

    function registroNovaDemanda($objEmpregado, $objContratos, $mail) {
        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = "#CONFIDENCIAL10 - Cadastro de demanda liquidação/Amortização SIAF #{{idDemanda}} - Empresa: $objContratos->CLIENTE - Contrato Caixa: $objContratos->CONTRATO_CAIXA - Contrato BNDES: $objContratos->CONTRATO_BNDES";
        $mail->Body = "
            <head>
                <meta charset=\"UTF-8\">
                <style>
                    body{
                        font-family: arial,verdana,sans serif;
                    }
                    p{
                        line-height: 1.0;
                    }
                    ol {
                        counter-reset: item
                    }
                    li {
                    display: block
                    }
                    li:before {
                    content: counters(item, '.') ' ';
                    counter-increment: item
                    }
                </style>
            </head>
            <p>À<br>
            $objContratos->NOME_PA</p>
          
            <p>Prezado(a) Gerente</p>
          
            <p>1. Comunicamos que recebemos o pedido de liquidação e/ou amortização e informamos que será processado no próximo dia 15 ou no 1º dia útil após o dia 15, quando este não for dia útil.</p>  
                <p>1.1 Informamos que somente serão acatados os pedidos cadastrados até 02 dias úteis antes do dia 15 do mês, conforme previsto na norma do produto.</p> 
                <p>1.2 Ressaltamos que as liquidações/amortizações somente ocorrem no dia 15 de cada mês ou no 1º dia útil após o dia 15, quando este não for dia útil.</p>  
            <p>2. Orientamos realizar no SIBAN o comando de liquidação/amortização conforme descrito na norma do produto.</p>
                <p>2.1 Os comandos de amortização/liquidação de contratos que não estejam em crédito em atraso são realizados pela agência, conforme abaixo:</p>
                    <p>- Acessa o SIBAN;</p>
                    <p>- Clica no ícone “empréstimos”;</p>
                    <p>- Na aba “Funções” selecionar a opção “Recebimento” e em seguida “Liquidação/Amortização Parcial”;</p>
                    <p>- No campo “contrato”, clica duas vezes na respectiva palavra e selecionar o nº do contrato;</p>
                    <p>- No campo “Valor pago” digitar o valor que se deseja amortizar/liquidar.</p>
                <p>2.2 Considerando que a posição de dívida dos contratos com custo SELIC só é verificada na data do vencimento, o comando de amortização/liquidação é realizado pela agência na data do no dia 15, impreterivelmente até às 11hs.</p>  
            <p>3. Os procedimentos para liquidação/amortização estão descritos na norma de cada produto.</p> 
            <p>4.  A conferência da liquidação poderá ser realizada pela agência no dia útil posterior a liquidação conforme procedimento descrito, na norma do produto, para verificação do saldo devedor.</p>
            <p>5.  Em caso de não liquidação por ausência de saldo em conta do cliente, a agência deverá efetuar nova solicitação de liquidação no mês subsequente.</p> 
            <p>6. Em caso de não liquidação por inconsistência do sistema, a CEOPC acionará o gestor do produto para providências cabíveis e comunicará a agência detentora do contrato.</p>
            <p>7. Dúvidas sobre o procedimento de liquidação/amortização devem ser encaminhadas para a Caixa postal CEOPC10. </p>
            <p>8. Dúvidas sobre a evolução ou cobrança dos contratos no SIBAN devem ser enviadas para o Gestor do produto (Caixa Postal GEPOD01.)</p> 

            <p>Atenciosamente,</p>
   
            <p>CEOPC - CN Operações do Corporativo</p>";
        
        $mail->AltBody = "
            À
            $objContratos->NOME_PA\n 

            Prezado(a) Gerente\n
            
            1. Comunicamos que recebemos o pedido de liquidação e/ou amortização e informamos que será processado no próximo dia 15 ou no 1º dia útil após o dia 15, quando este não for dia útil.\n
            1.1 Informamos que somente serão acatados os pedidos cadastrados até 02 dias úteis antes do dia 15 do mês, conforme previsto na norma do produto.\n 
            1.2 Ressaltamos que as liquidações/amortizações somente ocorrem no dia 15 de cada mês ou no 1º dia útil após o dia 15, quando este não for dia útil.\n  
            2. Orientamos realizar no SIBAN o comando de liquidação/amortização conforme descrito na norma do produto.\n
            2.1 Os comandos de amortização/liquidação de contratos que não estejam em crédito em atraso são realizados pela agência, conforme abaixo:\n
            - Acessa o SIBAN;\n
            - Clica no ícone “empréstimos”;\n
            - Na aba “Funções” selecionar a opção “Recebimento” e em seguida “Liquidação/Amortização Parcial”;\n
            - No campo “contrato”, clica duas vezes na respectiva palavra e selecionar o nº do contrato;\n
            - No campo “Valor pago” digitar o valor que se deseja amortizar/liquidar.\n
            2.2 Considerando que a posição de dívida dos contratos com custo SELIC só é verificada na data do vencimento, o comando de amortização/liquidação é realizado pela agência na data do no dia 15, impreterivelmente até às 11hs.\n
            3. Os procedimentos para liquidação/amortização estão descritos na norma de cada produto.\n 
            4.  A conferência da liquidação poderá ser realizada pela agência no dia útil posterior a liquidação conforme procedimento descrito, na norma do produto, para verificação do saldo devedor.\n
            5.  Em caso de não liquidação por ausência de saldo em conta do cliente, a agência deverá efetuar nova solicitação de liquidação no mês subsequente.\n 
            6. Em caso de não liquidação por inconsistência do sistema, a CEOPC acionará o gestor do produto para providências cabíveis e comunicará a agência detentora do contrato.\n
            7. Dúvidas sobre o procedimento de liquidação/amortização devem ser encaminhadas para a Caixa postal CEOPC10.\n 
            8. Dúvidas sobre a evolução ou cobrança dos contratos no SIBAN devem ser enviadas para o Gestor do produto (Caixa Postal GEPOD01.)\n 

            Atenciosamente,\n

            CEOPC - CN Operações do Corporativo";
        return $mail;
    }

    function pendenciaContaDivergente($objEmpregado, $objSiafAmortizacoes, $mail) {
        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = "#CONFIDENCIAL10 - Demanda #{{idDemanda}} inconforme - liquidação/Amortização SIAF (Solicitação com conta divergente do SIFBN) - Empresa: $objSiafAmortizacoes->NO_CLIENTE - Contrato Caixa: $objSiafAmortizacoes->CONTRATO_CAIXA - Contrato BNDES: $objSiafAmortizacoes->CONTRATO_BNDES";
        $mail->Body = "
            <head>
                <meta charset=\"UTF-8\">
                <style>
                    body{
                        font-family: arial,verdana,sans serif;
                    }
                    p{
                        line-height: 1.5;
                    }
                    ol {
                        counter-reset: item
                    }
                    li {
                    display: block
                    }
                    li:before {
                    content: counters(item, '.') ' ';
                    counter-increment: item
                    }
                </style>
            </head>
            <p>À<br>
            $objSiafAmortizacoes->NO_PA</p>

            <p>Prezado(a) Gerente</p>
            
            <ol>
                <li>Recebemos através do SIAF a solicitação de LIQUIDAÇÃO/AMORTIZAÇÃO referente ao contrato $objSiafAmortizacoes->CONTRATO_CAIXA.</li>
                <li>A conta cadastrada no SIAF ($objSiafAmortizacoes->CONTA_CORRENTE) diverge da conta cadastrada no SIBAN.</li>
                <li>Informamos que a alteração da conta no SIBAN é feita pela agência no seguinte caminho:</li>
                    <ul>
                        <li>módulo empréstimo,</li>
                        <li>função,</li>
                        <li>contrato,</li> 
                        <li>cadastramento de contratos - na tela principal - conta corrente de débito.</li>
                    </ul>
                <li>Desta forma, efetuamos o cancelamento da solicitação no SIAF para retificação da conta. </li>
                <li>Após regularização, orientamos efetuar nova solicitação no SIAF.</li>
            </ol>

            <p>Atenciosamente,</p>
   
            <p>CEOPC - CN Operações do Corporativo</p>";
        
        $mail->AltBody = "
            À
            $objSiafAmortizacoes->NOME_PA\n 

            Prezado(a) Gerente\n
            
            1. Recebemos através do SIAF a solicitação de LIQUIDAÇÃO/AMORTIZAÇÃO referente ao contrato $objSiafAmortizacoes->CONTRATO_CAIXA.\n

            2. A conta cadastrada no SIAF ($objSiafAmortizacoes->CONTA_CORRENTE) diverge da conta cadastrada no SIBAN (9999.000.00000000-0).\n

            3. Informamos que a alteração da conta no SIBAN  é feita pela agência no seguinte caminho: módulo empréstimo, função, contrato, cadastramento de contratos - na tela principal -  conta corrente de débito.\n

            4. Desta forma, efetuamos o cancelamento da solicitação no SIAF para retificação da conta.\n

            5. Após regularização, orientamos efetuar nova solicitação no SIAF.\n

            Atenciosamente,\n

            CEOPC - CN Operações do Corporativo";
        return $mail;
    }

    function pendenciaValorDivergenteSiafSiban($objEmpregado, $objSiafAmortizacoes, $mail) {
        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = "#CONFIDENCIAL10 - Demanda #{{idDemanda}} inconforme - liquidação/Amortização SIAF (Solicitação com valor divergente do SIFBN) - Empresa: $objSiafAmortizacoes->NO_CLIENTE - Contrato Caixa: $objSiafAmortizacoes->CONTRATO_CAIXA - Contrato BNDES: $objSiafAmortizacoes->CONTRATO_BNDES";
        $mail->Body = "
            <head>
                <meta charset=\"UTF-8\">
                <style>
                    body{
                        font-family: arial,verdana,sans serif;
                    }
                    p{
                        line-height: 1.5;
                    }
                    ol {
                        counter-reset: item
                    }
                    li {
                    display: block
                    }
                    li:before {
                    content: counters(item, '.') ' ';
                    counter-increment: item
                    }
                </style>
            </head>
            <p>À<br>
            $objSiafAmortizacoes->NO_PA</p>

            <p>Prezado(a) Gerente</p>
            
            <ol>
                <li>Recebemos através do SIAF a solicitação de LIQUIDAÇÃO referente ao contrato $objSiafAmortizacoes->CONTRATO_CAIXA.

                <li>O valor cadastrado no SIAF (R$ $objSiafAmortizacoes->VL_AMORTIZADO) diverge do valor do saldo devedor calculado pelo SIBAN.</li>

                <li>Informamos que o valor para liquidação pode ser consultado no sistema SIBAN/SIFBN no:</li>
                    <ul>
                        <li>menu Funções;</li>
                        <li>Recebimento;</li>
                        <li>Liquidação e amortização parcial – Campo Saldo Devedor.</li>
                    </ul>
                <li>Desta forma, efetuamos o cancelamento da solicitação no SIAF para retificação do valor.</li>

                <li>Após regularização, orientamos efetuar nova solicitação no SIAF.</li> 
            </ol>

            <p>Atenciosamente,</p>
   
            <p>CEOPC - CN Operações do Corporativo</p>";
        
        $mail->AltBody = "
            À
            $objSiafAmortizacoes->NOME_PA\n 

            Prezado(a) Gerente\n
            
            1. Recebemos através do SIAF a solicitação de LIQUIDAÇÃO referente ao contrato $objSiafAmortizacoes->CONTRATO_CAIXA.\n

            2. O valor cadastrado no SIAF (R$ $objSiafAmortizacoes->VL_AMORTIZADO) diverge do valor do saldo devedor calculado pelo SIBAN.\n

            3. Informamos que o valor para liquidação pode ser consultado no sistema SIBAN/SIFBN no menu Funções / Recebimento / Liquidação e amortização parcial – Campo Saldo Devedor.\n 

            3. Desta forma, efetuamos o cancelamento da solicitação no SIAF para retificação do valor.\n

            4. Após regularização, orientamos efetuar nova solicitação no SIAF.\n  

            Atenciosamente,\n

            CEOPC - CN Operações do Corporativo";
        return $mail;
    }

    function pendenciaSolicitacaoComContaPessoaFisica($objEmpregado, $objSiafAmortizacoes, $mail) {
        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = "#CONFIDENCIAL10 - Demanda #{{idDemanda}} inconforme - liquidação/Amortização SIAF (Solicitação com conta Pessoa Física) - Empresa: $objSiafAmortizacoes->NO_CLIENTE - Contrato Caixa: $objSiafAmortizacoes->CONTRATO_CAIXA - Contrato BNDES: $objSiafAmortizacoes->CONTRATO_BNDES";
        $mail->Body = "
            <head>
                <meta charset=\"UTF-8\">
                <style>
                    body{
                        font-family: arial,verdana,sans serif;
                    }
                    p{
                        line-height: 1.5;
                    }
                    ol {
                        counter-reset: item
                    }
                    li {
                    display: block
                    }
                    li:before {
                    content: counters(item, '.') ' ';
                    counter-increment: item
                    }
                </style>
            </head>
            <p>À<br>
            $objSiafAmortizacoes->NO_PA</p>

            <p>Prezado(a) Gerente</p>
            
            <ol>
                <li>Recebemos através do SIAF a solicitação de LIQUIDAÇÃO referente ao contrato $objSiafAmortizacoes->CONTRATO_CAIXA.</li>

                <li>Verificamos que a conta cadastrada para débito não pertence à empresa, assim para prosseguimento, solicitamos informar se há autorização formal do tomador e também do titular da conta para o débito desta operação na conta informada.</li>
                
                <li>Em caso de autorização, solicitamos formalizar para a caixa postal CEOPC10.</li>
                <ol>
                    <li>Ressaltamos que a autorização deve estar arquivada no dossiê da operação e não necessita ser encaminhada para a CEOPC.</li>
                </ol>
                <li>Após regularização, orientamos efetuar nova solicitação no SIAF.</li> 
            </ol>

            <p>Atenciosamente,</p>
   
            <p>CEOPC - CN Operações do Corporativo</p>";
        
        $mail->AltBody = "
            À
            $objSiafAmortizacoes->NOME_PA\n 

            Prezado(a) Gerente\n
            
            1. Recebemos através do SIAF a solicitação de LIQUIDAÇÃO referente ao contrato $objSiafAmortizacoes->CONTRATO_CAIXA.\n 

            2. Verificamos que a conta cadastrada para débito não pertence à empresa, assim para prosseguimento, solicitamos informar se há autorização formal do tomador e  também do titular da conta para o débito desta operação na conta informada.\n  
            
            3. Em caso de autorização, solicitamos formalizar para a caixa postal CEOPC10.\n  
            
            3.1  Ressaltamos que a autorização deve estar  arquivada no dossiê da operação e não necessita  ser encaminhada para a CEOPC.\n  
            
            4. Após regularização, orientamos efetuar nova solicitação no SIAF.\n  

            Atenciosamente,\n

            CEOPC - CN Operações do Corporativo";
        return $mail;
    }

}

