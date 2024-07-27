<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class PedidoController extends ResourceController
{
    protected $modelName = 'App\Models\PedidoModel';
    protected $format = 'json';

    public function index()
    {
        $pedidos = $this->model->findAll();
        $pedidoProdutoModel = new \App\Models\PedidoProdutoModel();
        $produtoModel = new \App\Models\ProdutoModel();

        foreach ($pedidos as &$pedido) {
            $pedidoProdutos = $pedidoProdutoModel->where('pedido_id', $pedido['id'])->findAll();
            foreach ($pedidoProdutos as &$pedidoProduto) {
                $produto = $produtoModel->find($pedidoProduto['produto_id']);
                $pedidoProduto['produto'] = $produto;
            }
            $pedido['produtos'] = $pedidoProdutos;
        }

        return $this->respond($pedidos);
    }

    public function show($id = null)
    {
        $data = $this->model->find($id);
        if ($data) {
            $pedidoProdutoModel = new \App\Models\PedidoProdutoModel();
            $produtoModel = new \App\Models\ProdutoModel();

            $pedidoProdutos = $pedidoProdutoModel->where('pedido_id', $id)->findAll();
            foreach ($pedidoProdutos as &$pedidoProduto) {
                $produto = $produtoModel->find($pedidoProduto['produto_id']);
                $pedidoProduto['produto'] = $produto;
            }
            $data['produtos'] = $pedidoProdutos;

            return $this->respond($data);
        } else {
            return $this->failNotFound('Pedido não encontrado.');
        }
    }

    public function create()
    {
        $db = \Config\Database::connect();
        $data = $this->request->getJSON(true);

        if (!isset($data['produtos']) || !is_array($data['produtos'])) {
            return $this->failValidationError('Dados de produtos inválidos.');
        }

        $db->transStart();

        try {
            $pedidoData = [
                'usuario_id' => 1,
                'status' => 'comprado'
            ];
            if (!$this->model->insert($pedidoData)) {
                throw new \Exception('Erro ao criar o pedido.');
            }
            $pedidoId = $this->model->getInsertID();

            $pedidoProdutoModel = new \App\Models\PedidoProdutoModel();

            foreach ($data['produtos'] as $produto) {
                $pedidoProdutoData = [
                    'pedido_id' => $pedidoId,
                    'produto_id' => $produto['id'],
                    'quantidade' => $produto['quantidade']
                ];

                if (!$pedidoProdutoModel->insert($pedidoProdutoData)) {
                    throw new \Exception('Erro ao adicionar produto ao pedido: ' . json_encode($pedidoProdutoModel->errors()));
                }
            }

            $db->transComplete();

            if ($db->transStatus() === false) {
                throw new \Exception('Erro na transação do banco de dados.');
            }

            return $this->respondCreated(['pedido_id' => $pedidoId, 'message' => 'Pedido criado com sucesso.']);
        } catch (\Exception $e) {
            $db->transRollback();
            log_message('error', 'Erro ao processar pedido: ' . $e->getMessage());
            return $this->fail('Erro ao processar pedido: ' . $e->getMessage());
        }
    }

    public function update($id = null)
    {
        $data = $this->request->getRawInput();
        if ($this->model->update($id, $data)) {
            return $this->respond($data);
        } else {
            return $this->failValidationError($this->model->errors());
        }
    }

    public function delete($id = null)
    {
        if ($this->model->delete($id)) {
            return $this->respondDeleted(['id' => $id]);
        } else {
            return $this->failNotFound('Pedido não encontrado.');
        }
    }

    public function cancel($id = null)
    {
        $pedidoProdutoModel = new \App\Models\PedidoProdutoModel();

        try {
            if (!$pedidoProdutoModel->where('pedido_id', $id)->delete()) {
                throw new \Exception('Erro ao deletar produtos do pedido.');
            }

            if (!$this->model->delete($id)) {
                throw new \Exception('Erro ao deletar o pedido.');
            }

            return $this->respondDeleted(['id' => $id, 'message' => 'Pedido cancelado com sucesso.']);
        } catch (\Exception $e) {
            log_message('error', 'Erro ao cancelar pedido: ' . $e->getMessage());
            return $this->fail('Erro ao cancelar pedido: ' . $e->getMessage());
        }
    }
}
