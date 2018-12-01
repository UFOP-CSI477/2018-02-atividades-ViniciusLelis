<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{

  private $nome_equipamento;

  protected $fillable = [
    'id',
    'equipamento_id',
    'descricao',
    'datalimite',
    'tipo',
    'created_at',
    'updated_at'
  ];

  public function getNomeEquipamento() {
    return $this->nome_equipamento;
  }

  public function setNomeEquipamento($value) {
    $this->nome_equipamento = $value;
  }

  public function getTipoRegistro() {
    switch($this->tipo) {
      case 1: return 'Preventiva'; break;
      case 2: return 'Corretiva'; break;
      case 3: return 'Urgente'; break;
      default: return '-'; break;
    }
  }

}