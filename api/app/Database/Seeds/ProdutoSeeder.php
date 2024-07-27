<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProdutoSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nome' => 'Produto 1',
                'peso' => '1.5',
                'tipo' => 'fisico',
                'preco' => '29.90',
            ],
            [
                'nome' => 'Produto 2',
                'peso' => '2.0',
                'tipo' => 'digital',
                'preco' => '49.90',
            ],
            [
                'nome' => 'Produto 3',
                'peso' => '0.5',
                'tipo' => 'fisico',
                'preco' => '19.90',
            ],
        ];

        $this->db->table('produtos')->insertBatch($data);
    }
}
