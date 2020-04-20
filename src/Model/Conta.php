<?php
namespace MimMarcelo\API\ContaContas\Model;

use Illuminate\Database\Eloquent\Model;
/**
 * Description of Conta
 *
 * @author Marcelo Júnior
 */
class Conta extends Model
{
    protected $fillable = ['nome', 'valor'];
    public $timestamps = false;
}
