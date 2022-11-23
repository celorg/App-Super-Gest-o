<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $table = 'produtos';
    protected $fillable = ['nome','descricao','peso','unidade_id','fornecedor_id'];

    public function ItemDetalhe(){
        return $this->hasOne('App\Models\ItemDetalhe', 'produto_id','id');
    }

    public function fornecedor(){
        return $this->belongsTo('App\Models\Fornecedores', 'fornecedor_id','id');
    }

    public function pedidos(){
        return $this->belongsToMany('App\Models\Pedido','pedidos_produtos','produto_id','pedido_id');
    }
}
