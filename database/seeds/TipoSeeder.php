<?php

use Illuminate\Database\Seeder;
use MimMarcelo\API\ContaContas\Model\Tipo\Tipo;

class TipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tipo::create([
            "sigla" => "GNR",
            "nome" => "General",
            "tipo_conta" => -1
        ]);
    }
}
