<?php

namespace App\Models;

use CodeIgniter\Model;

class PedidoProdutoModel extends Model
{
    protected $table = 'pedido_produto';
    protected $primaryKey = 'id';
    protected $allowedFields = ['pedido_id', 'produto_id', 'quantidade'];

    protected $validationRules = [
        'pedido_id' => 'required|integer',
        'produto_id' => 'required|integer',
        'quantidade' => 'required|integer',
    ];

    protected $validationMessages = [
        'pedido_id' => [
            'required' => 'O campo Pedido é obrigatório.',
            'integer'  => 'O campo Pedido deve ser um número inteiro.'
        ],
        'produto_id' => [
            'required' => 'O campo Produto é obrigatório.',
            'integer'  => 'O campo Produto deve ser um número inteiro.'
        ],
        'quantidade' => [
            'required' => 'O campo Quantidade é obrigatório.',
            'integer'  => 'O campo Quantidade deve ser um número inteiro.'
        ],
    ];
}
