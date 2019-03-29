<?php	
// VERIFICA SE EXISTEM ERROS DE EXECUÇÃO NO CÓDIGO
ini_set('display_errors',1);

// CRIAÇÃO DA CLASSE
class GrupoCelula
{
    // DEFINIÇÃO DOS ATRIBUTOS
    private $nomeCelula;
    private $matriculaGestor;
    private $nomeGestor;

    // $nomeCelula
    public function getNomeCelula()
    {
        return $this->nomeCelula;
    }
    public function setNomeCelula($nomeCelula)
    {
        $this->nomeCelula = $nomeCelula;
    }

    // $matriculaGestor
    public function getMatriculaGestor()
    {
        return $this->matriculaGestor;
    }
    public function setMatriculaGestor($matriculaGestor)
    {
        $this->matriculaGestor = $matriculaGestor;
    }

    // $nomeGestor
    public function getNomeGestor()
    {
        return $this->nomeGestor;
    }
    public function setNomeGestor($nomeGestor)
    {
        $this->nomeGestor = $nomeGestor;
    }

    // MÉTODO PARA LISTAR TODAS AS CÉLULAS DA CEOPC
    public function listarCelulasCeopc()
    {
        $sql = new Sql();

        try
        { 
            $listaCelulasCeopc = $sql->select
            (
                "SELECT 
                    [ID]
                    ,[NOME_CELULA]
                FROM 
                    [tbl_CEOPC_GRUPOS_CELULAS]"
            );
            return json_encode($listaCelulasCeopc, JSON_UNESCAPED_SLASHES);
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
}