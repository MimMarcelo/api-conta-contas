<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace MimMarcelo\API\ContaContas\Controllers;

use MimMarcelo\API\ContaContas\Model\Periodo;
/**
 * Description of BaseController
 *
 * @author Marcelo Júnior
 */
class PeriodoController extends ResponseController
{    
    public function index(int $ano, int $mes) {
        $periodo = new Periodo();
        $retorno = $periodo::all($ano, $mes);
        if(is_string($retorno)){
            return $this->responseError($retorno);
        }
        return $this->responseData($retorno);
    }
}
