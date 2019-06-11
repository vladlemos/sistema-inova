<?php

use Illuminate\Database\Seeder;

class AcessaEmpregadoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('TBL_ACESSA_EMPREGADOS')->insert(['matricula' => 'c111710', 'nivelAcesso' => 'MASTER', 'unidade' => '5459',]);
    }
}
