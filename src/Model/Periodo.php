<?php

namespace MimMarcelo\API\ContaContas\Model;

use MimMarcelo\API\ContaContas\Model\Helper\ValidateFields;
/**
 * Description of Periodo
 *
 * @author Marcelo Júnior
 */
class Periodo implements ValidateFields{
    
    public static function all(int $ano, int $mes)
    {
        if(!Periodo::checkAno($ano)){
            return "O ano deve ser um número";
        }
        if(!Periodo::checkMes($mes)){
            return "O mês deve ser um número entre 1 e 12";
        }
        
        $contas = Conta::query()
                ->whereMonth("data", "=", $mes)
                ->whereYear("data", "=", $ano)
                ->orderBy("data")
                ->get();
        return $contas;
    }

    private static function checkAno(int $ano): bool
    {
        if(!is_int($ano)){
            return false;
        }
        return true;
    }
    
    private static function checkMes(int $mes): bool
    {
        if(!is_int($mes)){
            return false;
        }
        if($mes < 1 || $mes > 12){
            return false;
        }
        return true;
    }
    public static function validateFields(): array {
        return [
            "m" => "required|int|in:1,2,3,4,5,6,7,8,9,10,11,12",
            "y" => "required|int"
        ];
    }

}
