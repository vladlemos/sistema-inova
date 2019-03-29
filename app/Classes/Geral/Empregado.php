<?php	
// VERIFICA SE EXISTEM ERROS DE EXECUÇÃO NO CÓDIGO
ini_set('display_errors',1);

// CRIAÇÃO DA CLASSE
class Empregado 
{	
	// DEFINIÇÃO DOS ATRIBUTOS
	private $matricula; 
	private $nome;
	private $lotacaoAdm;
	private $nomeLotacaoAdm;
	private $lotacaoFisica;
	private $nomeLotacaoFisica;
	private $nivelAcesso;
	private $funcao;
	private $dataAdmissao;

	// MÉTODOS

	// GETTERS E SETTERS DOS ATRIBUTOS
	
	// $matricula
	public function getMatricula()
	{
		return $this->matricula;
	}
	public function setMatricula($value)
	{
		$this->matricula = $value;
	}

	// $nome
	public function getNome()
	{
		return $this->nome;
	}
	public function setNome($value)
	{
		$this->nome = $value;		
	}

	// $lotacaoAdm
	public function getLotacaoAdm()
	{
		return $this->lotacaoAdm;
	}
	public function setLotacaoAdm($value)
	{
		$this->lotacaoAdm = $value;		
	}

	// $nomeLotacaoAdm
	public function getNomeLotacaoAdm()
	{
		return $this->nomeLotacaoAdm;
	}
	public function setNomeLotacaoAdm($value)
	{
		$this->nomeLotacaoAdm = $value;		
	}

	// $lotacaoFisica
	public function getLotacaoFisica()
	{
		return $this->lotacaoFisica;
	}
	public function setLotacaoFisica($value)
	{
		$this->lotacaoFisica = $value;		
	}

	// $nomeLotacaoFisica
	public function getNomeLotacaoFisica()
	{
		return $this->nomeLotacaoFisica;
	}
	public function setNomeLotacaoFisica($value)
	{
		$this->nomeLotacaoFisica = $value;		
	}

	// $nivelAcesso
	public function getNivelAcesso()
	{
		return $this->nivelAcesso;
	}
	public function setNivelAcesso($value)
	{
		$this->nivelAcesso = $value;		
	}

	// $funcao
	public function getFuncao()
	{
		return $this->funcao;
	}
	public function setFuncao($value)
	{
		$this->funcao = $value;		
	}

	// $dataAdmissao
	public function getDataAdmissao()
	{
		return $this->dataAdmissao;
	}
	public function setDataAdmissao($value)
	{
		$this->dataAdmissao = $value;	
	}

	// METODO MÁGICO PARA SETTAR TODOS OS ATRIBUTOS
	public function __construct()
	{	
		// ATRIBUIÇÃO DA VARIÁVEL MATRÍCULA
		$this->setMatricula(substr($_SERVER["LOGON_USER"],strpos($_SERVER["LOGON_USER"], "\\")+1));

		$sql = new Sql();

		$result = $sql->select("SELECT          
									[NIVEL]           
								FROM 
									[tbl_ACESSA_EMPREGADO] 
								WHERE [MATRICULA] = :MATRICULA", array(
									':MATRICULA'=>$this->getMatricula(),
								));
		if(!empty($result))
		{
			$row = $result[0];
			// ATRIBUIÇÃO DA VARIÁVEL E NÍVEL DE ACESSO
			$this->setNivelAcesso($row['NIVEL']);
		}

		$capturaDadosBanco = $sql->select("SELECT 
												[NOME]
												,[DATA_CONTRATACAO]
												,[FUNCAO]
												,[CODIGO_UNIDADE_LOTACAO_ADMINISTRATIVA]
												,[UNIDADE_LOTACAO_ADMINISTRATIVA]
												,[CODIGO_UNIDADE_LOTACAO_FISICA]
												,[UNIDADE_LOTACAO_FISICA]
											FROM 
												[EMPREGADOS]
											WHERE
												MATRICULA = '" . str_replace(array("c", "C"),"", $this->getMatricula() . "'")
											);
		
		if(!empty($capturaDadosBanco))
		{
			$row2 = $capturaDadosBanco[0];

			// ATRIBUIÇÃO DAS VARIÁVEIS NOME, LOTAÇÃO_FISICA, FUNÇÃO E DATA_CONTRATAÇÃO
			$this->setNome($row2['NOME']);
			$this->setLotacaoAdm($row2['CODIGO_UNIDADE_LOTACAO_ADMINISTRATIVA']);
			$this->setNomeLotacaoAdm($row2['UNIDADE_LOTACAO_ADMINISTRATIVA']);
			$this->setLotacaoFisica($row2['CODIGO_UNIDADE_LOTACAO_FISICA']);
			$this->setNomeLotacaoFisica($row2['UNIDADE_LOTACAO_FISICA']);
			$this->setFuncao($row2['FUNCAO']);
			$this->setDataAdmissao($row2['DATA_CONTRATACAO']);
		}
	}
	
	// METODO PARA SETTAR TODOS OS ATRIBUTOS DE EMPREGADO QUE NÃO ESTEJA NA SESSÃO
	public function settarEmpregado($matricula)
	{	
		// ATRIBUIÇÃO DA VARIÁVEL MATRÍCULA
		$this->setMatricula($matricula);

		$sql = new Sql();

		$result = $sql->select("SELECT       
									[NIVEL]  
 								FROM 
									[tbl_ACESSA_EMPREGADO] 
								WHERE [MATRICULA] = :MATRICULA", array(
									':MATRICULA'=>$this->getMatricula(),
								));
		if(!empty($result))
		{
			$row = $result[0];
			// ATRIBUIÇÃO DA VARIÁVEL E NÍVEL DE ACESSO
			$this->setNivelAcesso($row['NIVEL']);
		}

		$capturaDadosBanco = $sql->select("SELECT 
												[NOME]
												,[DATA_CONTRATACAO]
												,[FUNCAO]
												,[CODIGO_UNIDADE_LOTACAO_ADMINISTRATIVA]
												,[UNIDADE_LOTACAO_ADMINISTRATIVA]
												,[CODIGO_UNIDADE_LOTACAO_FISICA]
												,[UNIDADE_LOTACAO_FISICA]
											FROM 
												[EMPREGADOS]
											WHERE
												MATRICULA = '" . str_replace(array("c", "C"),"", $this->getMatricula() . "'")
											);
		
		if(!empty($capturaDadosBanco))
		{
			$row2 = $capturaDadosBanco[0];

			// ATRIBUIÇÃO DAS VARIÁVEIS NOME, LOTAÇÃO_FISICA, FUNÇÃO E DATA_CONTRATAÇÃO
			$this->setNome($row2['NOME']);
			$this->setLotacaoAdm($row2['CODIGO_UNIDADE_LOTACAO_ADMINISTRATIVA']);
			$this->setNomeLotacaoAdm($row2['UNIDADE_LOTACAO_ADMINISTRATIVA']);
			$this->setLotacaoFisica($row2['CODIGO_UNIDADE_LOTACAO_FISICA']);
			$this->setNomeLotacaoFisica($row2['UNIDADE_LOTACAO_FISICA']);
			$this->setFuncao($row2['FUNCAO']);
			$this->setDataAdmissao($row2['DATA_CONTRATACAO']);
		}
	}

	// MÉTODO PARA TRAZER OS DADOS DO OBJETO COMO JSON
	public function __toString()
	{
		return json_encode(array(
			"matricula"=>$this->getMatricula(),
			"nome_empregado"=>$this->getNome(),
			"codigo_lotacao_administrativa"=>$this->getLotacaoAdm(),
			"nome_lotacao_administrativa"=>$this->getNomeLotacaoAdm(),
			"codigo_lotacao_fisica"=>$this->getLotacaoFisica(),
			"nome_lotacao_fisica"=>$this->getNomeLotacaoFisica(),
			"nivel_acesso"=>$this->getNivelAcesso(),
			"funcao"=>$this->getFuncao(),
			"data_admissao"=>$this->getDataAdmissao(),
		), JSON_UNESCAPED_SLASHES);
	}	
}
?>