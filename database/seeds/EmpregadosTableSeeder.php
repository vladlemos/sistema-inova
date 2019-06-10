<?php

use Illuminate\Database\Seeder;

class EmpregadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('TBL_EMPREGADOS')->insert([
            'matricula' => 'c111710',
            'nomeCompleto' => 'EDUARDO CHIAKI CHUMAN',
            'primeiroNome' => 'EDUARDO',
            'dataNascimento' => '13/03/1986',
            'codigoFuncao' => '2057',
            'nomeFuncao' => 'ASSISTENTE PLENO',
            'codigoLotacaoAdministrativa' => '5459',
            'nomeLotacaoAdministrativa' => 'CN OPERACOES DO CORPORATIVO',
            'codigoLotacaoFisica' => null,
            'nomeLotacaoFisica' => null,
        ]);
    }
}
