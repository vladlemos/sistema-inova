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
            case 'pendenciaContratoCreditoEmAtraso':
                return $this->pendenciaContratoCreditoEmAtraso($objEmpregado, $objContratos, $mail);
            break;
            case 'contratoLiquidadoOuAmortizado':
                return $this->contratoLiquidadoOuAmortizado($objEmpregado, $objContratos, $mail);
            break;
            case 'pendenciaContratoNaoLiquidadoResiduo':
                return $this->pendenciaContratoNaoLiquidadoResiduo($objEmpregado, $objContratos, $mail);
            break;
            case 'pendenciaContratoNaoLiquidadoPorAusenciaSaldo':
                return $this->pendenciaContratoNaoLiquidadoPorAusenciaSaldo($objEmpregado, $objContratos, $mail);
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
        $mail->Subject = "#CONFIDENCIAL10 - Solicitação de liquidação/Amortização SIAF #{{idDemanda}} - Empresa: $objContratos->CLIENTE - Contrato Caixa: $objContratos->CONTRATO_CAIXA";
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

            <ol>
                <li>Comunicamos que recebemos o pedido de liquidação e/ou amortização e informamos que será processado no próximo dia 15 ou no 1º dia útil seguinte.</li>  
                <li>Orientamos realizar no SIBAN o comando de liquidação/amortização conforme descrito na norma do produto.</li>  
                <li>Considerando que a posição de dívida dos contratos com custo SELIC só é verificada na data do vencimento, o comando de amortização/liquidação é realizado pela agência no dia 15, impreterivelmente até às 11hs.</li>   
                <li>A conferência da liquidação poderá ser realizada pela agência no dia útil posterior a liquidação conforme procedimento descrito, na norma do produto, para verificação do saldo devedor.</li>  
                <li>Em caso de não liquidação por ausência de saldo em conta do cliente, a agência deverá efetuar nova solicitação de liquidação no mês subsequente.</li>   
                <li>Dúvidas sobre o procedimento de liquidação/amortização devem ser encaminhadas para a Caixa postal CEOPC10.</li>  
                <li>Dúvidas sobre a evolução ou cobrança dos contratos no SIBAN devem ser enviadas para o Gestor do produto (Caixa Postal GEPOD01).</li>  
            </ol>

            <p>Atenciosamente,</p>
   
            <p>CEOPC - CN Operações do Corporativo</p>";
        
        $mail->AltBody = "
            À
            $objContratos->NOME_PA\n 

            Prezado(a) Gerente\n
            
            1. Comunicamos que recebemos o pedido de liquidação e/ou amortização e informamos que será processado no próximo dia 15 ou no 1º dia útil seguinte.\n
            2. Orientamos realizar no SIBAN o comando de liquidação/amortização conforme descrito na norma do produto.\n  
            3. Considerando que a posição de dívida dos contratos com custo SELIC só é verificada na data do vencimento, o comando de amortização/liquidação é realizado pela agência no dia 15, impreterivelmente até às 11hs.\n
            4. A conferência da liquidação poderá ser realizada pela agência no dia útil posterior a liquidação conforme procedimento descrito, na norma do produto, para verificação do saldo devedor.\n
            5. Em caso de não liquidação por ausência de saldo em conta do cliente, a agência deverá efetuar nova solicitação de liquidação no mês subsequente.\n
            6. Dúvidas sobre o procedimento de liquidação/amortização devem ser encaminhadas para a Caixa postal CEOPC10.\n
            7. Dúvidas sobre a evolução ou cobrança dos contratos no SIBAN devem ser enviadas para o Gestor do produto (Caixa Postal GEPOD01).\n

            Atenciosamente,\n

            CEOPC - CN Operações do Corporativo";
        return $mail;
    }

    function pendenciaContaDivergente($objEmpregado, $objSiafAmortizacoes, $mail) {
        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = "#CONFIDENCIAL10 - Demanda #{{idDemanda}} cancelada - Solicitação com conta divergente do SIFBN - Empresa: $objSiafAmortizacoes->NO_CLIENTE - Contrato Caixa: $objSiafAmortizacoes->CONTRATO_CAIXA";
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
                <li>Entretanto verificamos que a conta cadastrada no SIAF ($objSiafAmortizacoes->CONTA_CORRENTE) diverge da conta cadastrada no SIBAN.</li>
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

            2. Entretanto verificamos que a conta cadastrada no SIAF ($objSiafAmortizacoes->CONTA_CORRENTE) diverge da conta cadastrada no SIBAN (9999.000.00000000-0).\n

            3. Informamos que a alteração da conta no SIBAN é feita pela agência no seguinte caminho: módulo empréstimo, função, contrato, cadastramento de contratos - na tela principal -  conta corrente de débito.\n

            4. Desta forma, efetuamos o cancelamento da solicitação no SIAF para retificação da conta.\n

            5. Após regularização, orientamos efetuar nova solicitação no SIAF.\n

            Atenciosamente,\n

            CEOPC - CN Operações do Corporativo";
        return $mail;
    }

    function pendenciaValorDivergenteSiafSiban($objEmpregado, $objSiafAmortizacoes, $mail) {
        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = "#CONFIDENCIAL10 - Demanda #{{idDemanda}} cancelada - Solicitação com valor divergente do SIFBN - Empresa: $objSiafAmortizacoes->NO_CLIENTE - Contrato Caixa: $objSiafAmortizacoes->CONTRATO_CAIXA";
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

                <li>Entretanto verificamos que o valor cadastrado no SIAF (R$ $objSiafAmortizacoes->VL_AMORTIZADO) diverge do valor do saldo devedor calculado pelo SIBAN.</li>

                <li>Informamos que o valor para liquidação pode ser consultado no sistema SIBAN/SIFBN no:</li>
                    <ul>
                        <li>menu Funções;</li>
                        <li>Recebimento;</li>
                        <li>Liquidação e amortização parcial – Campo Saldo Devedor.</li>
                    </ul>
                <li>Desta forma, efetuamos o cancelamento da solicitação no SIAF para retificação do valor.</li>

                <li>Orientamos efetuar nova solicitação no SIAF com o valor correto.</li> 
            </ol>

            <p>Atenciosamente,</p>
   
            <p>CEOPC - CN Operações do Corporativo</p>";
        
        $mail->AltBody = "
            À
            $objSiafAmortizacoes->NOME_PA\n 

            Prezado(a) Gerente\n
            
            1. Recebemos através do SIAF a solicitação de LIQUIDAÇÃO referente ao contrato $objSiafAmortizacoes->CONTRATO_CAIXA.\n

            2. Entretanto verificamos que o valor cadastrado no SIAF (R$ $objSiafAmortizacoes->VL_AMORTIZADO) diverge do valor do saldo devedor calculado pelo SIBAN.\n

            3. Informamos que o valor para liquidação pode ser consultado no sistema SIBAN/SIFBN no menu Funções / Recebimento / Liquidação e amortização parcial – Campo Saldo Devedor.\n 

            3. Desta forma, efetuamos o cancelamento da solicitação no SIAF para retificação do valor.\n

            4. Orientamos efetuar nova solicitação no SIAF com o valor correto.\n  

            Atenciosamente,\n

            CEOPC - CN Operações do Corporativo";
        return $mail;
    }

    function pendenciaSolicitacaoComContaPessoaFisica($objEmpregado, $objSiafAmortizacoes, $mail) {
        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = "#CONFIDENCIAL10 - Demanda #{{idDemanda}} cancelada - Solicitação com conta Pessoa Física - Empresa: $objSiafAmortizacoes->NO_CLIENTE - Contrato Caixa: $objSiafAmortizacoes->CONTRATO_CAIXA";
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
                <li>A liquidação/amortização somente será efetivada após o recebimento da autorização</li> 
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
            
            4. A liquidação/amortização somente será efetivada após o recebimento da autorização\n  

            Atenciosamente,\n

            CEOPC - CN Operações do Corporativo";
        return $mail;
    }

    function pendenciaContratoCreditoEmAtraso($objEmpregado, $objSiafAmortizacoes, $mail) {
        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = "#CONFIDENCIAL10 - Demanda #{{idDemanda}} cancelada - Solicitação com crédito em atraso - Empresa: $objSiafAmortizacoes->NO_CLIENTE - Contrato Caixa: $objSiafAmortizacoes->CONTRATO_CAIXA";
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
                <li>Recebemos através do SIAF a solicitação de LIQUIDAÇÃO/AMORTIZAÇÃO referente ao contrato $objSiafAmortizacoes->CONTRATO_CAIXA, no entanto o SIBAN informa que o contrato está com o status de Crédito em atraso.</li>
                <li>Haja vista que o contrato encontra-se em CA não é possível efetuarmos a liquidação do mesmo, conforme disposto na norma do produto.</li>
                <li>Informamos que para contratos na situação de crédito em atraso deve ser observado o disposto no CO451.</li>
                <li>A presente demanda foi cancelada, após regularização do contrato, para liquidação/amortização, nova demanda deverá ser cadastrada no SIAF.</li>
            </ol>

            <p>Atenciosamente,</p>
   
            <p>CEOPC - CN Operações do Corporativo</p>";
        
        $mail->AltBody = "
            À
            $objSiafAmortizacoes->NOME_PA\n 

            Prezado(a) Gerente\n
            
            1. Recebemos através do SIAF a solicitação de LIQUIDAÇÃO/AMORTIZAÇÃO referente ao contrato $objSiafAmortizacoes->CONTRATO_CAIXA, no entanto o SIBAN informa que o contrato está com o status de Crédito em atraso.\n

            2. Haja vista que o contrato encontra-se em CA não é possível efetuarmos a liquidação do mesmo, conforme disposto na norma do produto.\n

            3. Informamos que para contratos na situação de crédito em atraso deve ser observado o disposto no CO451.\n

            4. A presente demanda foi cancelada, após regularização do contrato, para liquidação/amortização, nova demanda deverá ser cadastrada no SIAF.\n

            Atenciosamente,\n

            CEOPC - CN Operações do Corporativo";
        return $mail;
    }

    function contratoLiquidadoOuAmortizado($objEmpregado, $objSiafAmortizacoes, $mail) {
        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = "#CONFIDENCIAL10 - Demanda #{{idDemanda}} conforme - Empresa: $objSiafAmortizacoes->NO_CLIENTE - Contrato Caixa: $objSiafAmortizacoes->CONTRATO_CAIXA";
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
                <li>Comunicamos que a liquidação/amortização do contrato $objSiafAmortizacoes->CONTRATO_CAIXA ocorreu com sucesso.</li>
                <li>Orientamos que a Agência/PA/PLAT/SGE efetue a verificação no SIBAN, conforme abaixo:
                    <ul>
                        <li>Acessa o SIBAN;</li>
                        <li>Clica no ícone “empréstimos”;</li>
                        <li>Na aba “relatórios” selecionar a opção “relatórios gerais contratos”;</li>
                        <li>Seleciona a opção “ Histórico do Contrato ”  no caso de liquidação ou “Evolução do Contrato” em caso de amortização;</li>
                        <li>No campo “contrato”, clica duas vezes na respectiva palavra e selecionar o nº do contrato, e posteriormente clica no ícone para visualização do relatório;</li>
                        <li>O SIBAN apresentará na tela o relatório que pode ser impresso pelo usuário.</li>
                    </ul>
                <li>Em caso de inconsistência, orientamos encaminhar mensagem para a caixa postal CEOPC10.</li> 
            </ol>

            <p>Atenciosamente,</p>
   
            <p>CEOPC - CN Operações do Corporativo</p>";
        
        $mail->AltBody = "
            À
            $objSiafAmortizacoes->NOME_PA\n 

            Prezado(a) Gerente\n
            
            1. Comunicamos que a liquidação/amortização do contrato $objSiafAmortizacoes->CONTRATO_CAIXA ocorreu com sucesso.\n 
            
            2. Orientamos que a Agência/PA/PLAT/SGE efetue a verificação no SIBAN, conforme abaixo:\n

                    - Acessa o SIBAN;\n

                    - Clica no ícone “empréstimos”;\n

                    - Na aba “relatórios” selecionar a opção “relatórios gerais contratos”;\n

                    - Seleciona a opção “ Histórico do Contrato ”  no caso de liquidação ou “Evolução do Contrato” em caso de amortização;\n

                    - No campo “contrato”, clica duas vezes na respectiva palavra e selecionar o nº do contrato, e posteriormente clica no ícone para visualização do relatório;\n

                    - O SIBAN apresentará na tela o relatório que pode ser impresso pelo usuário.\n

            3. Em caso de inconsistência, orientamos encaminhar mensagem para a caixa postal CEOPC10.\n

            Atenciosamente,\n

            CEOPC - CN Operações do Corporativo";
        return $mail;
    }

    function pendenciaContratoNaoLiquidadoResiduo($objEmpregado, $objSiafAmortizacoes, $mail) {
        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = "#CONFIDENCIAL10 - Demanda #{{idDemanda}} - Pendente de regularização - Empresa: $objSiafAmortizacoes->NO_CLIENTE - Contrato Caixa: $objSiafAmortizacoes->CONTRATO_CAIXA";
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
                <li>Comunicamos que o contrato foi liquidado junto ao BNDES, mas devido a saldo residual, no SIBAN, não ocorreu a liquidação do contrato na CAIXA.</li>
                <li>Desta forma, o contrato permanece com o status ATIVO no SIBAN.</li>
                <li>Informamos que a GEPOD01 analisará a situação do contrato e tomará as providências cabíveis para a regularização no SIBAN.</li>
                <li>Orientamos <b>não abrir</b> nova demanda de liquidação no SIAF.</li>
                <li>Em caso de dúvidas, orientamos contatar o gestor do produto através da caixa postal GEPOD01.</li> 
            </ol>

            <p>Atenciosamente,</p>
   
            <p>CEOPC - CN Operações do Corporativo</p>";
        
        $mail->AltBody = "
            À
            $objSiafAmortizacoes->NOME_PA\n 

            Prezado(a) Gerente\n
            
            Comunicamos que o contrato foi liquidado junto ao BNDES, mas devido a saldo residual, no SIBAN, não ocorreu a liquidação do contrato na CAIXA.\n
            
            Desta forma, o contrato permanece com o status ATIVO no SIBAN.\n

            Informamos que a GEPOD01 analisará a situação do contrato e tomará as providências cabíveis para a regularização no SIBAN.\n

            Orientamos não abrir nova demanda de liquidação no SIAF.\n

            Em caso de dúvidas, orientamos contatar o gestor do produto através da caixa postal GEPOD01.\n

            Atenciosamente,\n

            CEOPC - CN Operações do Corporativo";
        return $mail;
    }

    function pendenciaContratoNaoLiquidadoPorAusenciaSaldo($objEmpregado, $objSiafAmortizacoes, $mail) {
        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = "#CONFIDENCIAL10 - Demanda #{{idDemanda}} cancelada - Não Liquidado por Ausência de Saldo - Empresa: $objSiafAmortizacoes->NO_CLIENTE - Contrato Caixa: $objSiafAmortizacoes->CONTRATO_CAIXA";
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
                <li>Comunicamos que o contrato $objSiafAmortizacoes->CONTRATO_CAIXA  não foi liquidado/amortizado devido a ausência de saldo suficiente na conta do cliente no momento da efetivação da liquidação e/ou amortização, entretanto, a caixa honrou o pagamento junto ao BNDES.</li>
                <li>Assim, para liquidação junto a CAIXA, orientamos manter o saldo em conta no próximo dia 15 ou no 1º dia útil seguinte para que possamos efetuar o débito.</li>
                <li>Lembramos que também deve ser efetuado um novo comando de amortização e/ou liquidação no SIBAN, conforme  disposto na norma do produto.</li> 
                <li>Caso não seja mais de interesse do cliente efetuar liquidação e/ou amortização do contrato, solicitamos formalizar <b>de imediato</b> para a caixa postal CEOPC10 para que possamos ter tempo hábil de recuperar o valor pago junto ao BNDES.</li>
            </ol>

            <p>Atenciosamente,</p>
   
            <p>CEOPC - CN Operações do Corporativo</p>";
        
        $mail->AltBody = "
            À
            $objSiafAmortizacoes->NOME_PA\n 

            Prezado(a) Gerente\n
            
            Comunicamos que o contrato $objSiafAmortizacoes->CONTRATO_CAIXA  não foi liquidado/amortizado devido a ausência de saldo suficiente na conta do cliente no momento da efetivação da liquidação e/ou amortização, entretanto, a caixa honrou o pagamento junto ao BNDES.\n
            
            Assim, para liquidação junto a CAIXA, orientamos manter o saldo em conta no próximo dia 15 ou no 1º dia útil seguinte para que possamos efetuar o débito.\n

            Lembramos que também deve ser efetuado um novo comando de amortização e/ou liquidação no SIBAN, conforme  disposto na norma do produto.\n

            Caso não seja mais de interesse do cliente efetuar liquidação e/ou amortização do contrato, solicitamos formalizar de imediato para a caixa postal CEOPC10 para que possamos ter tempo hábil de recuperar o valor pago junto ao BNDES.\n

            Atenciosamente,\n

            CEOPC - CN Operações do Corporativo";
        return $mail;
    }
}