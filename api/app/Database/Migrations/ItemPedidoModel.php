<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemPedidoModel extends Model
{
    protected $table = 'itens_pedido';
    protected $primaryKey = 'id';
    protected $allowedFields = ['pedido_id', 'produto_id', 'quantidade', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
}
