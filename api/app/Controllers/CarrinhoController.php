<?php

namespace App\Controllers;

use App\Models\CarrinhoModel;
use App\Models\PedidoModel;
use App\Models\PedidoProdutoModel;
use CodeIgniter\RESTful\ResourceController;

class CarrinhoController extends ResourceController
{
    protected $modelName = 'App\Models\CarrinhoModel';
    protected $format    = 'json';

    public function index()
    {
        return $this->respond($this->model->findAll());
    }

    public function create()
    {
        $data = $this->request->getPost();
        if ($this->model->insert($data)) {
            return $this->respondCreated($data);
        } else {
            return $this->failValidationError('Erro ao adicionar produto no carrinho.');
        }
    }

    public function delete($id = null)
    {
        if ($this->model->delete($id)) {
            return $this->respondDeleted('Produto removido do carrinho.');
        } else {
            return $this->failNotFound('Produto não encontrado.');
        }
    }

    public function finalizar()
    {
        $carrinhoModel = new CarrinhoModel();
        $pedidoModel = new PedidoModel();
        $pedidoProdutoModel = new PedidoProdutoModel();

        $carrinho = $carrinhoModel->where('status', 'carrinho')->findAll();

        if (empty($carrinho)) {
            return $this->failNotFound('Carrinho vazio.');
        }

        $pedidoData = [
            'usuario_id' => 1,
            'status' => 'comprado'
        ];
        $pedidoId = $pedidoModel->insert($pedidoData);
        
        foreach ($carrinho as $item) {
            $pedidoProdutoData = [
                'pedido_id' => $pedidoId,
                'produto_id' => $item['produto_id'],
                'quantidade' => $item['quantidade']
            ];
            $pedidoProdutoModel->insert($pedidoProdutoData);
            
            $carrinhoModel->update($item['id'], ['status' => 'comprado']);
        }

        return $this->respond(['message' => 'Compra finalizada com sucesso.', 'pedido_id' => $pedidoId]);
    }
}
