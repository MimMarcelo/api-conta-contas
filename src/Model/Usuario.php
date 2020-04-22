<?php

namespace MimMarcelo\API\ContaContas\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable;
use MimMarcelo\API\ContaContas\Model\Helper\ValidateFields;
/**
 * Description of Usuario
 *
 * @author marcelo
 */
class Usuario extends Model implements Authenticatable, Authorizable,ValidateFields
{
    use \Illuminate\Auth\Authenticatable, \Laravel\Lumen\Auth\Authorizable;
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
