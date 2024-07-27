<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdutoModel extends Model
{
    protected $table      = 'produtos';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = ['nome', 'peso', 'tipo', 'preco'];

    protected $validationRules    = [
        'nome' => 'required|string|max_length[255]',
        'peso' => 'required|decimal',
        'tipo' => 'required|string|max_length[255]',
        'preco' => 'required|decimal',
    ];

    protected $validationMessages = [
        'nome' => [
            'required' => 'O campo Nome é obrigatório.',
            'string' => 'O campo Nome deve ser uma string.',
            'max_length' => 'O campo Nome deve ter no máximo 255 caracteres.'
        ],
        'peso' => [
            'required' => 'O campo Peso é obrigatório.',
            'decimal' => 'O campo Peso deve ser um decimal.'
        ],
        'tipo' => [
            'required' => 'O campo Tipo é obrigatório.',
            'string' => 'O campo Tipo deve ser uma string.',
            'max_length' => 'O campo Tipo deve ter no máximo 255 caracteres.'
        ],
        'preco' => [
            'required' => 'O campo Preço é obrigatório.',
            'decimal' => 'O campo Preço deve ser um decimal.'
        ],
    ];
}
