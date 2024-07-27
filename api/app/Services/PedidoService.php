<?php

namespace App\Services;

use CodeIgniter\Database\Exceptions\DatabaseException;
use Exception;
use InvalidArgumentException;

class PedidoService
{
    protected $pedidoModel;
    protected $pedidoProdutoModel;

    public function __construct()
    {
        $this->pedidoModel = new \App\Models\PedidoModel();
        $this->pedidoProdutoModel = new \App\Models\PedidoProdutoModel();
    }

    public function criarPedido(array $data)
    {
        $db = \Config\Database::connect();

        if (!isset($data['produtos']) || !is_array($data['produtos'])) {
            throw new InvalidArgumentException('Dados de produtos inválidos.');
        }

        $db->transStart();

        try {
            log_message('debug', 'Iniciando criação do pedido');

            $pedidoData = [
                'usuario_id' => 1, // Certifique-se de que o ID do usuário está correto
                'status' => 'comprado'
            ];

            if (!$this->pedidoModel->insert($pedidoData)) {
                $errors = json_encode($this->pedidoModel->errors());
                log_message('error', 'Erro ao criar o pedido: ' . $errors);
                throw new Exception('Erro ao criar o pedido: ' . $errors);
            }

            $pedidoId = $this->pedidoModel->getInsertID();
            log_message('debug', 'Pedido criado com ID: ' . $pedidoId);

            foreach ($data['produtos'] as $produto) {
                $pedidoProdutoData = [
                    'pedido_id' => $pedidoId,
                    'produto_id' => $produto['id'],
                    'quantidade' => 1 // Você pode ajustar a quantidade conforme necessário
                ];

                if (!$this->pedidoProdutoModel->insert($pedidoProdutoData)) {
                    $errors = json_encode($this->pedidoProdutoModel->errors());
                    log_message('error', 'Erro ao adicionar produto ao pedido: ' . $errors);
                    throw new Exception('Erro ao adicionar produto ao pedido: ' . $errors);
                }
            }

            $db->transComplete();

            if ($db->transStatus() === false) {
                log_message('error', 'Erro na transação do banco de dados.');
                throw new Exception('Erro na transação do banco de dados.');
            }

            log_message('debug', 'Pedido e produtos adicionados com sucesso');
            return ['pedido_id' => $pedidoId, 'message' => 'Pedido criado com sucesso.'];
        } catch (Exception $e) {
            $db->transRollback();
            log_message('error', 'Erro ao processar pedido: ' . $e->getMessage());
            throw new DatabaseException('Erro ao processar pedido: ' . $e->getMessage());
        }
    }
}
