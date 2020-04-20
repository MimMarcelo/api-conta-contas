<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace MimMarcelo\API\ContaContas\Model\Tipo;

/**
 * Description of TipoConta
 *
 * @author Marcelo Júnior
 */
abstract class TipoConta {

    /** @var int $multiplicador */
    public $multiplicador;

    function __construct(int $multiplicador) 
    {
        $this->multiplicador = $multiplicador;
    }

    static function get(int $tipoConta): ?TipoConta 
    {
        $tipo = null;
        switch ($tipoConta) {
            case 1:
                $tipo = new Entrada();
                break;
            case 0:
                $tipo = new Neutro();
                break;
            case -1:
                $tipo = new Saida();
                break;
        }
        
        return $tipo;
    }

}
