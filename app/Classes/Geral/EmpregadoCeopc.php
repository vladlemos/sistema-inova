<?php	
// VERIFICA SE EXISTEM ERROS DE EXECUÇÃO NO CÓDIGO
ini_set('display_errors',1);

// CAMINHO ROTA FIXA
$caminho = $_SERVER["DOCUMENT_ROOT"];
require_once($caminho . DIRECTORY_SEPARATOR . "class" .  DIRECTORY_SEPARATOR . "Empregado.php");

// CRIAÇÃO DA CLASSE
class EmpregadoCeopc extends Empregado
{
    // DEFINIÇÃO DOS ATRIBUTOS
    private $idCelula;
    private $nomeCelula;
    private $nivelAcesso;
    private $eventualCelula;
    private $eventualCeopc;

    // $idCelula
    public function getIdCelula()
    {
        return $this->idCelula;
    }
    public function setIdCelula($value)
    {
        $this->idCelula = $value;
    }

    // $nomeCelula
    public function getNomeCelula()
    {
        return $this->nomeCelula;
    }
    public function setNomeCelula($value)
    {
        $this->nomeCelula = $value;
    }

    // $nivelAcesso
    public function getNivelAcesso()
    {
        return $this->nivelAcesso;
    }
    public function setNivelAcesso($nivelAcesso)
    {
        $this->nivelAcesso = $nivelAcesso;
    }

    // $eventualCelula
    public function getEventualCelula()
    {
        return $this->eventualCelula;
    }
    public function setEventualCelula($eventualCelula)
    {
        $this->eventualCelula = $eventualCelula;
    }

    // $eventualCeopc
    public function getEventualCeopc()
    {
        return $this->eventualCeopc;
    }
    public function setEventualCeopc($eventualCeopc)
    {
        $this->eventualCeopc = $eventualCeopc;
    }

    // MÉTODOS

    // CONSTRUCT
    public function __construct()
    {
        parent::__construct();
        
        $sql = new Sql();

        $consulta = $sql->select("SELECT 
                                    EMPREGADO.[MATRICULA]
                                    ,EMPREGADO.[DV]
                                    ,'ID_CELULA' = EMPREGADO.[ID_CELULA]
                                    ,'NOME_CELULA' = CELULAS.[NOME_CELULA]
                                    ,'NIVEL_ACESSO' = EMPREGADO.[NIVEL_ACESSO]
                                    ,'EVENTUAL_CELULA' = EMPREGADO.[EVENTUAL_CELULA]
                                    ,'EVENTUAL_CEOPC' = EMPREGADO.[EVENTUAL_CEOPC]
                                FROM 
                                    [tbl_CEOPC_EMPREGADO] AS EMPREGADO
                                    INNER JOIN tbl_CEOPC_GRUPOS_CELULAS AS CELULAS ON EMPREGADO.ID_CELULA = CELULAS.ID
                                WHERE 
                                    [MATRICULA] = :MATRICULA", array(
                                    ':MATRICULA'=>$this->getMatricula()
                                ));
        if(!empty($consulta))
        {
            $row = $consulta[0];
            // ATRIBUIÇÃO DAS VARIÁVEIS CÉLULA E NÍVEL DE ACESSO
            $this->setIdCelula($row['ID_CELULA']);
            $this->setNomeCelula($row['NOME_CELULA']);
            $this->setNivelAcesso($row['NIVEL_ACESSO']);
            $this->setEventualCelula($row['EVENTUAL_CELULA']);
            $this->setEventualCeopc($row['EVENTUAL_CEOPC']);
        }
    }

    // MÉTODO PARA LISTAR TODOS OS EMPREGADOS DA CEOPC
    public function listarEmpregadosCeopc()
    {
        $sql = new Sql();

        try
        { 
            $listaEmpregadosCeopc = $sql->select
            (
                "SELECT 
                    'MATRICULA' = EMPREGADO.[MATRICULA]
                    ,'NOME' = NOME.[NOME]
                    ,'NIVEL_ACESSO' = EMPREGADO.[NIVEL_ACESSO]
                    ,'ID_CELULA' = EMPREGADO.[ID_CELULA]
                    ,'NOME_CELULA' = CELULAS.[NOME_CELULA]
                    ,'MATRICULA_GESTOR' = CELULAS.[MATRICULA_GESTOR]
                    ,'NOME_GESTOR' = CELULAS.[NOME_GESTOR]    
                FROM 
                    [tbl_CEOPC_EMPREGADO] AS EMPREGADO
                    LEFT JOIN [EMPREGADOS] AS NOME ON CONVERT(BIGINT,REPLACE(EMPREGADO.[MATRICULA], 'c', '')) = NOME.[MATRICULA]
                    INNER JOIN [tbl_CEOPC_GRUPOS_CELULAS] AS CELULAS ON EMPREGADO.[ID_CELULA] = CELULAS.[ID]"
            );
			return json_encode($listaEmpregadosCeopc, JSON_UNESCAPED_SLASHES);
		} 
		catch (Exception $e) 
		{
			(
				array
				(
					"message"=>$e->getMessage(),
					"line"=>$e->getLine(),
					"file"=>$e->getFile(),
					"code"=>$e->getCode()
				)
			);
		}
    }

    // MÉTODO PARA LISTAR TODOS OS EMPREGADOS DA CÉLULA
    public function listarEmpregadosCelula($matriculaGestor)
    {
        $sql = new Sql();

        try
        { 
            $listaEmpregadosCelula = $sql->select
            (
                "SELECT 
                    'MATRICULA' = EMPREGADO.[MATRICULA]
                    ,'NOME' = NOME.[NOME]
                    ,'NIVEL_ACESSO' = EMPREGADO.[NIVEL_ACESSO]
                    ,'ID_CELULA' = EMPREGADO.[ID_CELULA]
                    ,'NOME_CELULA' = CELULAS.[NOME_CELULA]
                    ,'MATRICULA_GESTOR' = CELULAS.[MATRICULA_GESTOR]
                    ,'NOME_GESTOR' = CELULAS.[NOME_GESTOR]    
                FROM 
                    [tbl_CEOPC_EMPREGADO] AS EMPREGADO
                    LEFT JOIN [EMPREGADOS] AS NOME ON CONVERT(BIGINT,REPLACE(EMPREGADO.[MATRICULA], 'c', '')) = NOME.[MATRICULA]
                    INNER JOIN [tbl_CEOPC_GRUPOS_CELULAS] AS CELULAS ON EMPREGADO.[ID_CELULA] = CELULAS.[ID]
                WHERE
                    CELULAS.[MATRICULA_GESTOR] = :ID_MATRICULA",
                    array
                    (
                        ':ID_MATRICULA'=>$matriculaGestor,
                    )
            );
            return json_encode($listaEmpregadosCelula, JSON_UNESCAPED_SLASHES);
        } 
        catch (Exception $e) 
        {
            (
                array
                (
                    "message"=>$e->getMessage(),
                    "line"=>$e->getLine(),
                    "file"=>$e->getFile(),
                    "code"=>$e->getCode()
                )
            );
        }
    }

    // MÉTODO PARA ATUALIZAR A CÉLULA DE UM EMPREGADO
    public function atualizaCelulaEmpregados($idCelula, $matricula)
    {
        $this->setIdCelula($idCelula);
        $this->setMatricula($matricula);

        $sql = new Sql();

        try
        { 
            $sql->select
            (
                "UPDATE [dbo].[tbl_CEOPC_EMPREGADO]
                SET 
                    [ID_CELULA] = :ID_CELULA
                WHERE 
                    [MATRICULA] = :MATRICULA", 
                array
                (
                    ':ID_CELULA'=>$this->getIdCelula(),
                    ':MATRICULA'=>$this->getMatricula()
                )
            );
        } 
        catch (Exception $e) 
        {
            (
                array
                (
                    "message"=>$e->getMessage(),
                    "line"=>$e->getLine(),
                    "file"=>$e->getFile(),
                    "code"=>$e->getCode()
                )
            );
        }
    }

    // MÉTODO PARA ATUALIZAR A EVENTUALIDADE DA CÉLULA
    public function atualizaEventualidadeCelula($matriculaEventual)
    {
        $this->setMatricula($matriculaEventual);
        
        $sql = new Sql();

        try
        { 
            $sql->select
            (
                "UPDATE [dbo].[tbl_CEOPC_EMPREGADO]
                SET 
                    [EVENTUAL] = 'SIM'
                WHERE 
                    [MATRICULA] = :MATRICULA", 
                array
                (
                    ':MATRICULA'=>$this->getMatricula()
                )
            );
        } 
        catch (Exception $e) 
        {
            (
                array
                (
                    "message"=>$e->getMessage(),
                    "line"=>$e->getLine(),
                    "file"=>$e->getFile(),
                    "code"=>$e->getCode()
                )
            );
        }
    }

    // MÉTODO PARA ATUALIZAR A EVENTUALIDADE DA CÉLULA
    public function atualizaEventualidadeCeopc($matriculaEventual)
    {
        $this->setMatricula($matriculaEventual);
        
        $sql = new Sql();

        try
        { 
            $sql->select
            (
                "UPDATE [dbo].[tbl_CEOPC_EMPREGADO]
                SET 
                    [EVENTUAL_CEOPC] = 'SIM'
                WHERE 
                    [MATRICULA] = :MATRICULA", 
                array
                (
                    ':MATRICULA'=>$this->getMatricula()
                )
            );
        } 
        catch (Exception $e) 
        {
            (
                array
                (
                    "message"=>$e->getMessage(),
                    "line"=>$e->getLine(),
                    "file"=>$e->getFile(),
                    "code"=>$e->getCode()
                )
            );
        }
    }

    // MÉTODO PARA ZERAR AS EVENTUALIDADES DAS CÉLULAS
    public function limpaEventualidadeCelula($idCelula)
    {
        $this->setIdCelula($idCelula);
        
        $sql = new Sql();

        try
        { 
            $sql->select
            (
                "UPDATE [dbo].[tbl_CEOPC_EMPREGADO]
                SET 
                    [EVENTUAL] = 'NAO'
                WHERE 
                    [ID_CELULA] = :ID_CELULA", 
                array
                (
                    ':ID_CELULA'=>$this->getIdCelula()
                )
            );
        } 
        catch (Exception $e) 
        {
            (
                array
                (
                    "message"=>$e->getMessage(),
                    "line"=>$e->getLine(),
                    "file"=>$e->getFile(),
                    "code"=>$e->getCode()
                )
            );
        }
    }

    // MÉTODO PARA ZERAR AS EVENTUALIDADE DA CEOPC
    public function limpaEventualidadeCeopc($idCelula)
    {
        $this->setIdCelula($idCelula);
        
        $sql = new Sql();

        try
        { 
            $sql->select
            (
                "UPDATE [dbo].[tbl_CEOPC_EMPREGADO]
                SET 
                    [EVENTUAL_CEOPC] = 'NAO'"
            );
        } 
        catch (Exception $e) 
        {
            (
                array
                (
                    "message"=>$e->getMessage(),
                    "line"=>$e->getLine(),
                    "file"=>$e->getFile(),
                    "code"=>$e->getCode()
                )
            );
        }
    }

	// MÉTODO PARA TRAZER OS DADOS DO OBJETO COMO JSON
	public function __toString()
	{
		return json_encode(array(
			"MATRICULA"=>$this->getMatricula(),
            "NOME"=>$this->getNome(),
            "ID_CELULA"=>$this->getIdCelula(),
            "NOME_CELULA"=>$this->getNomeCelula(),
			"NIVEL_ACESSO"=>$this->getNivelAcesso(),
			"FUNCAO"=>$this->getFuncao(),
		), JSON_UNESCAPED_SLASHES);
    }
    
    // MÉTODO PARA TRAZER OS DADOS DO OBJETO COMO ARRAY ASSOCIATIVO
	public function dadosEmpregadoCeopc()
	{
		return array(
			"matricula"=>$this->getMatricula(),
            "nome"=>$this->getNome(),
            "idCelula"=>$this->getIdCelula(),
            "nomeCelula"=>$this->getNomeCelula(),
			"nivelAcesso"=>$this->getNivelAcesso(),
            "funcao"=>$this->getFuncao(),
            "eventualCelula"=>$this->getEventualCelula(),
            "eventualCeopc"=>$this->getEventualCeopc()
		);
	}
}

?>