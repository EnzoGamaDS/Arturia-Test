<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePedidoProdutoTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INTEGER',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'pedido_id' => [
                'type'       => 'INTEGER',
                'unsigned'   => true,
            ],
            'produto_id' => [
                'type'       => 'INTEGER',
                'unsigned'   => true,
            ],
            'quantidade' => [
                'type'       => 'INTEGER',
                'unsigned'   => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('pedido_id', 'pedidos', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('produto_id', 'produtos', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pedido_produto');
    }

    public function down()
    {
        $this->forge->dropTable('pedido_produto');
    }
}
