<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace MimMarcelo\API\ContaContas\Controllers;

use MimMarcelo\API\ContaContas\Model\Conta;
/**
 * Description of ContasController
 *
 * @author Marcelo Júnior
 */
class ContasController extends BaseController
{
    public function __construct() {
        parent::__construct(Conta::class);
    }

    public function camposParaValidar(): array {
        return [
            "nome" => "required",
            "valor" => "required",
            "tipo_id" => "exists:MimMarcelo\API\ContaContas\Model\Tipo\Tipo,id"
        ];
    }

}
