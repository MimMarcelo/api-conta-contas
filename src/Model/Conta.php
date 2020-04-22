<?php
namespace MimMarcelo\API\ContaContas\Model;

use Illuminate\Database\Eloquent\Model;
use MimMarcelo\API\ContaContas\Model\Helper\ValidateFields;
/**
 * Description of Conta
 *
 * @author Marcelo Júnior
 */
class Conta extends Model implements ValidateFields
{
    public $timestamps = false;
    
    protected $fillable = ['nome', 'valor', 'tipo_id', 'data'];
    protected $hidden = ['tipo_id'];
    protected $casts = [
        'valor' => 'double',
    ];
    protected $appends = ['tipo'];
    
    public function tipo() {
        return $this->hasOne(Tipo::class);
    }
    
    public function getTipoAttribute() {
        return Tipo::find($this->attributes['tipo_id']);
    }

    public static function validateFields(): array {
        return [
            "nome" => "required",
            "valor" => "required",
            "tipo_id" => "required|exists:MimMarcelo\API\ContaContas\Model\Tipo,id",
            "data" => "required|date"
        ];
    }

}
