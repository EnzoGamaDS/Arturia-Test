<?php

namespace App\Repositories;

use App\Models\PedidoModel;
use App\Models\PedidoProdutoModel;

class PedidoRepository
{
    protected $pedidoModel;
    protected $pedidoProdutoModel;

    public function __construct()
    {
        $this->pedidoModel = new PedidoModel();
        $this->pedidoProdutoModel = new PedidoProdutoModel();
    }

    public function getAll()
    {
        return $this->pedidoModel->findAll();
    }

    public function getById($id)
    {
        return $this->pedidoModel->find($id);
    }

    public function create(array $data)
    {
        return $this->pedidoModel->insert($data);
    }

    public function update($id, array $data)
    {
        return $this->pedidoModel->update($id, $data);
    }

    public function delete($id)
    {
        return $this->pedidoModel->delete($id);
    }

    public function getInsertID()
    {
        return $this->pedidoModel->insertID();
    }

    public function getPedidoProdutos($pedidoId)
    {
        return $this->pedidoProdutoModel->where('pedido_id', $pedidoId)->findAll();
    }

    public function deletePedidoProdutos($pedidoId)
    {
        return $this->pedidoProdutoModel->where('pedido_id', $pedidoId)->delete();
    }

    public function createPedidoProduto(array $data)
    {
        return $this->pedidoProdutoModel->insert($data);
    }
}
