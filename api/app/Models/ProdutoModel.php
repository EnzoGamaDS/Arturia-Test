<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdutoModel extends Model
{
    protected $table = 'produtos';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nome', 'peso', 'tipo'];

    protected $validationRules = [
        'nome' => 'required|min_length[3]|max_length[255]',
        'peso' => 'required',
        'tipo' => 'required|in_list[fisico,digital]',
    ];
}
