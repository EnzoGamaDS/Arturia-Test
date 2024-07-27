<?php

namespace App\Models;

use CodeIgniter\Model;

class PedidoModel extends Model
{
    protected $table = 'pedidos';
    protected $primaryKey = 'id';
    protected $allowedFields = ['usuario_id', 'status'];

    protected $validationRules = [
        'usuario_id' => 'required|integer',
        'status' => 'required|in_list[carrinho,comprado]',
    ];
}
