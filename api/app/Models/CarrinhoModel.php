<?php

namespace App\Models;

use CodeIgniter\Model;

class CarrinhoModel extends Model
{
    protected $table      = 'carrinho';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = ['produto_id', 'quantidade', 'status'];

    protected $validationRules    = [
        'produto_id' => 'required|integer',
        'quantidade' => 'required|integer',
        'status'     => 'required|string'
    ];

    protected $validationMessages = [
        'produto_id' => [
            'required' => 'O campo Produto é obrigatório.',
            'integer'  => 'O campo Produto deve ser um número inteiro.'
        ],
        'quantidade' => [
            'required' => 'O campo Quantidade é obrigatório.',
            'integer'  => 'O campo Quantidade deve ser um número inteiro.'
        ],
        'status' => [
            'required' => 'O campo Status é obrigatório.',
            'string'   => 'O campo Status deve ser uma string.'
        ],
    ];
}
