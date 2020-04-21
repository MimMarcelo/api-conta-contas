<?php

namespace MimMarcelo\API\ContaContas\Model;

use Illuminate\Database\Eloquent\Model;
use MimMarcelo\API\ContaContas\Model\Helper\ValidateFields;
/**
 * Description of Tipo
 *
 * @author Marcelo Júnior
 */
class Tipo extends Model implements ValidateFields
{
    const TIPO_CONTA = ["entrada" => 1, "neutro" => 0, "saida" => -1];
    
    public $timestamps = false;
    
    protected $table = "tipos_conta";
    protected $fillable = ['sigla', 'nome', 'tipo_conta'];
    protected $casts = [
        'tipo_conta' => 'int',
    ];

    public function conta() {
        return $this->belongsTo(Conta::class);
    }
    
    public static function validateFields(): array {
        return [
            "sigla" => "required",
            "nome" => "required",
            "tipo_conta" => "required|in:". implode(",", Tipo::TIPO_CONTA)
        ];
    }

}
