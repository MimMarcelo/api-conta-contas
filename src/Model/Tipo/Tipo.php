<?php

namespace MimMarcelo\API\ContaContas\Model\Tipo;

use Illuminate\Database\Eloquent\Model;
use MimMarcelo\API\ContaContas\Model\Conta;

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

    public function conta() {
        return $this->belongsTo(Conta::class);
    }
    
    public function getTipoContaAttribute($tipoConta) {
        return TipoConta::get($tipoConta);
    }
}
