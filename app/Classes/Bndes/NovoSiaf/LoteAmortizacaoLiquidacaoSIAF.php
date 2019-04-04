<?php

namespace App\Classes\Bndes\NovoSiaf;

class LoteAmortizacaoLiquidacaoSIAF
{
	private $dataLoteAtual;
	private $dataLoteAnterior;
	private $dataLimiteParaCadastroDeDemanda;

	// $dataLoteAtual
	public function getDataLoteAtual()
	{
		return $this->dataLoteAtual;
	}
	public function setDataLoteAtual()
	{
		if(date("d") <= 13)
		{
			$this->dataLoteAtual = date('d/m/Y', strtotime(date("Y") . '-' . sprintf('%02d', date('m')) . '-15'));
		}
		else
		{
			if(date("m") <= 9)
			{	
				$this->dataLoteAtual = date('d/m/Y', strtotime(date("Y") . '-' . sprintf("%02d", (date('m')+1)) . '-15'));
			}
			else	
			{
				$this->dataLoteAtual = date('d/m/Y', strtotime(date("Y") . '-' . (date('m')+1) . '-15'));
			}
		}
	}

	// $dataLoteAnterior;
	public function getDataLoteAnterior()
	{
		return $this->dataLoteAnterior;
	}
	public function setDataLoteAnterior()
	{
		if(date("d") <= 13)
		{
			if(date("m") == 1)
			{	
				$this->dataLoteAnterior = date('d/m/Y', strtotime((date("Y")-1) . '-12-15'));				
			}	
			else	
			{	
				$this->dataLoteAnterior = date('d/m/Y', strtotime(date("Y") . '-' . sprintf("%02d", (date('m') - 1)) . '-15'));
			}
		} 
		else
		{
			$this->dataLoteAnterior = date('d/m/Y', strtotime(date("Y") . '-' . date('m') . '-15'));
		}
	}

	// $dataLimiteParaCadastroDeDemanda
	public function getDataLimiteParaCadastroDeDemanda()
	{
		return $this->dataLimiteParaCadastroDeDemanda;
	}
	public function setDataLimiteParaCadastroDeDemanda()
	{
		$this->dataLimiteParaCadastroDeDemanda = date('d/m/Y', strtotime(date('Y') . '-' . sprintf("%02d", date('m')) . '-13'));
		switch (date('w', strtotime($this->dataLimiteParaCadastroDeDemanda))) 
		{
			case '0':
			case '1':
				$this->dataLimiteParaCadastroDeDemanda = date('d/m/Y', strtotime(date('Y') . '-' . sprintf("%02d", date('m')) . '-11'));
				// echo "é fim de semana <br>";
				break; 
			case '6':
				$this->dataLimiteParaCadastroDeDemanda = date('d/m/Y', strtotime(date('Y') . '-' . sprintf("%02d", date('m')) . '-12'));
				// echo "é fim de semana <br>";
				break;    
			default:
				$this->dataLimiteParaCadastroDeDemanda = date('d/m/Y', strtotime(date('Y') . '-' . sprintf("%02d", date('m')) . '-13'));
				// echo "não é fim de semana <br>";
				break;
		}

		if (date('d/m/Y', getdate() >= $this->dataLimiteParaCadastroDeDemanda)) 
		{
			$this->dataLimiteParaCadastroDeDemanda = date('d/m/Y', strtotime(date('Y') . '-' . sprintf("%02d", (date('m') +1)) . '-15'));
			switch (date('w', strtotime($this->dataLimiteParaCadastroDeDemanda))) 
			{
				case '0':
				case '1':
					$this->dataLimiteParaCadastroDeDemanda = date('d/m/Y', strtotime(date('Y') . '-' . sprintf("%02d", date('m')+1) . '-11'));
					// echo "é fim de semana ou segunda-feira <br>";
					break;
				case '6':
					$this->dataLimiteParaCadastroDeDemanda = date('d/m/Y', strtotime(date('Y') . '-' . sprintf("%02d", date('m')+1) . '-12'));
					// echo "é fim de semana <br>";
					break;    
				default:
					$this->dataLimiteParaCadastroDeDemanda = date('d/m/Y', strtotime(date('Y') . '-' . sprintf("%02d", date('m')+1) . '-13'));
					// echo "não é fim de semana <br>";
					break;
			}
		}
	}
	
	public function __construct()
	{
		$this->setDataLoteAtual();
		$this->setDataLoteAnterior();
		$this->setDataLimiteParaCadastroDeDemanda();
	}

	public function __toString()
	{
		return json_encode(array(
			'data_lote_atual'=>$this->getDataLoteAtual(),
			'data_lote_anterior'=>$this->getDataLoteAnterior(),
			'data_limite_para_cadastro_de_demanda'=>$this->getDataLimiteParaCadastroDeDemanda(),
		), JSON_UNESCAPED_SLASHES);
		
	}
}

// $lote = new LoteAmortizacaoLiquidacaoSIAF;

// echo $lote;