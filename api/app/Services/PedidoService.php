<?php

namespace App\Services;

use App\Contracts\PedidoServiceInterface;
use App\Repositories\PedidoRepository;
use App\Models\ProdutoModel;
use Exception;

class PedidoService implements PedidoServiceInterface
{
    protected $repository;

    public function __construct(PedidoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll()
    {
        $pedidos = $this->repository->getAll();
        $produtoModel = new ProdutoModel();

        foreach ($pedidos as &$pedido) {
            $pedidoProdutos = $this->repository->getPedidoProdutos($pedido['id']);
            foreach ($pedidoProdutos as &$pedidoProduto) {
                $produto = $produtoModel->find($pedidoProduto['produto_id']);
                $pedidoProduto['produto'] = $produto;
            }
            $pedido['produtos'] = $pedidoProdutos;
        }

        return $pedidos;
    }

    public function getById($id)
    {
        $pedido = $this->repository->getById($id);
        if ($pedido) {
            $produtoModel = new ProdutoModel();

            $pedidoProdutos = $this->repository->getPedidoProdutos($id);
            foreach ($pedidoProdutos as &$pedidoProduto) {
                $produto = $produtoModel->find($pedidoProduto['produto_id']);
                $pedidoProduto['produto'] = $produto;
            }
            $pedido['produtos'] = $pedidoProdutos;
        }
        return $pedido;
    }

    public function create(array $data)
    {
        $db = \Config\Database::connect();
        if (!isset($data['produtos']) || !is_array($data['produtos'])) {
            throw new Exception('Dados de produtos inválidos.');
        }

        $db->transStart();

        try {
            $pedidoData = [
                'usuario_id' => 1,
                'status' => 'comprado'
            ];
            if (!$this->repository->create($pedidoData)) {
                throw new Exception('Erro ao criar o pedido.');
            }
            $pedidoId = $this->repository->getInsertID();

            foreach ($data['produtos'] as $produto) {
                $pedidoProdutoData = [
                    'pedido_id' => $pedidoId,
                    'produto_id' => $produto['id'],
                    'quantidade' => $produto['quantidade']
                ];

                if (!$this->repository->createPedidoProduto($pedidoProdutoData)) {
                    throw new Exception('Erro ao adicionar produto ao pedido.');
                }
            }

            $db->transComplete();

            if ($db->transStatus() === false) {
                throw new Exception('Erro na transação do banco de dados.');
            }

            return ['pedido_id' => $pedidoId, 'message' => 'Pedido criado com sucesso.'];
        } catch (Exception $e) {
            $db->transRollback();
            log_message('error', 'Erro ao processar pedido: ' . $e->getMessage());
            throw new Exception('Erro ao processar pedido: ' . $e->getMessage());
        }
    }

    public function update($id, array $data)
    {
        if (!$this->repository->update($id, $data)) {
            throw new Exception('Erro ao atualizar o pedido.');
        }
        return $data;
    }

    public function delete($id)
    {
        if (!$this->repository->delete($id)) {
            throw new Exception('Erro ao deletar o pedido.');
        }
        return ['id' => $id];
    }

    public function cancel($id)
    {
        try {
            if (!$this->repository->deletePedidoProdutos($id)) {
                throw new Exception('Erro ao deletar produtos do pedido.');
            }

            if (!$this->repository->delete($id)) {
                throw new Exception('Erro ao deletar o pedido.');
            }

            return ['id' => $id, 'message' => 'Pedido cancelado com sucesso.'];
        } catch (Exception $e) {
            log_message('error', 'Erro ao cancelar pedido: ' . $e->getMessage());
            throw new Exception('Erro ao cancelar pedido: ' . $e->getMessage());
        }
    }
}
