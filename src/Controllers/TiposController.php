<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace MimMarcelo\API\ContaContas\Controllers;

use MimMarcelo\API\ContaContas\Model\Tipo\Tipo;
/**
 * Description of ContasController
 *
 * @author Marcelo Júnior
 */
class TiposController extends BaseController
{
    public function __construct() {
        parent::__construct(Tipo::class);
    }

    public function camposParaValidar(): array {
        return [
            "sigla" => "required",
            "nome" => "required"
        ];
    }

}
