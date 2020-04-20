<?php

namespace MimMarcelo\API\ContaContas\Model\Tipo;

use Illuminate\Database\Eloquent\Model;
/**
 * Description of Tipo
 *
 * @author Marcelo Júnior
 */
class Tipo extends Model
{
    protected $table = "tipos_conta";
    protected $fillable = ['sigla', 'nome', 'tipo_conta'];
    public $timestamps = false;
    
    public function getTipoContaAttribute($tipoConta) {
        return TipoConta::get($tipoConta);
    }
}
