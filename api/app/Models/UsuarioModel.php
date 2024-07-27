<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nome', 'email'];
    
    protected $validationRules = [
        'nome' => 'required|min_length[3]|max_length[255]',
        'email' => 'required|valid_email'
    ];
}
