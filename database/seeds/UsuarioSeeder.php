<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use MimMarcelo\API\ContaContas\Model\Usuario;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Usuario::create([
            'email' => "rokermarcelo@gmail.com",
            'password' => Hash::make("Senha12#")
        ]);
    }
}
