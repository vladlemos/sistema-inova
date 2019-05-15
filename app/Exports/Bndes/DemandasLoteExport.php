<?php

namespace App\Exports\Bndes;

use App\Models\Bndes\NovoSiaf\SiafDemanda;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class DemandasLoteExport implements FromQuery, WithMapping, WithHeadings
{
    use Exportable;
    protected $dataLote;

    public function __construct(string $dataLote)
    {
        $this->dataLote = str_replace("-","/", $dataLote); 
    }

    public function query()
    {
        return SiafDemanda::query()->where('dataLote', $this->dataLote);
    }
    /**
    * @var DemandasLoteExport $dataLoteExport
    */
    public function map($dataLoteExport): array
    {
        if ($dataLoteExport->tipoOperacao == "L") {
            $tipoOperacao = "Liquidação";
        } else {
            $tipoOperacao = "Amortização";
        }
        
        return [
            $dataLoteExport->codigoDemanda,
            $dataLoteExport->nomeCliente,
            $this->mask($dataLoteExport->cnpj, '##.###.###/####-##'),
            $dataLoteExport->contratoCaixa,
            $dataLoteExport->contratoBndes,
            number_format($dataLoteExport->valorOperacao, 2, ',', '.'),
            $tipoOperacao,
            $dataLoteExport->contaDebito,
            $dataLoteExport->status,
            $dataLoteExport->dataCadastramento,
            $dataLoteExport->dataLote,
            $dataLoteExport->codigoPa,
            $dataLoteExport->codigoSr,
            $dataLoteExport->codigoGigad,
            $dataLoteExport->matriculaSolicitante,
        ];
    }

    public function headings(): array
    {
        return ["DEMANDA", "EMPRESA", "CNPJ", "CONTRATO CAIXA", "CONTRATO BNDES", "VALOR DA OPERAÇÃO", "TIPO OPERAÇÃO", "CONTA DEBITO", "STATUS", "DATA CADASTRAMENTO", "LOTE AMORTIZACAO", "COD AGÊNCIA", "COD SR", "COD GIGAD",  "MATRICULA SOLICITANTE"];
    }

    public function mask($val, $mask)
    {
        $maskared = '';
        $k = 0;
        for($i = 0; $i<=strlen($mask)-1; $i++) {
            if($mask[$i] == '#') {
                if(isset($val[$k]))
                    $maskared .= $val[$k++];
            } else {
                if(isset($mask[$i]))
                    $maskared .= $mask[$i];
            }
        }
        return $maskared;
    }
    
}
