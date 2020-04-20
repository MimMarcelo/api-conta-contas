<?php
namespace MimMarcelo\API\ContaContas\Model;

use Illuminate\Database\Eloquent\Model;
use MimMarcelo\API\ContaContas\Model\Tipo\Tipo;
/**
 * Description of Conta
 *
 * @author Marcelo Júnior
 */
class Conta extends Model
{
    protected $fillable = ['nome', 'valor', 'tipo_id'];
    protected $appends = ['tipo'];
    
    public $timestamps = false;
    
    public function tipo() {
        return $this->hasOne(Tipo::class);
    }
    
    public function getTipoAttribute() {
        return Tipo::find($this->attributes['tipo_id']);
    }
}
