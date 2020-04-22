<?php

namespace MimMarcelo\API\ContaContas\Model;

use Illuminate\Database\Eloquent\Model;
use MimMarcelo\API\ContaContas\Model\Helper\ValidateFields;
/**
 * Description of Usuario
 *
 * @author marcelo
 */
class Usuario extends Model implements ValidateFields
{
    public $timestamps = false;
    
    protected $fillable = ['email', 'password'];
    protected $hidden = ['password'];
    
    public static function validateFields(): array {
        return [
            "email" => "required|email",
            "password" => "required"
        ];
    }

}
