<?php

namespace App\Controllers;

use App\Models\CarrinhoModel;
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
        $data = $this->model->where('status', 'carrinho')->findAll();
        foreach ($data as $item) {
            $item['status'] = 'comprado';
            $this->model->update($item['id'], $item);
        }
        return $this->respond(['message' => 'Compra finalizada com sucesso.']);
    }
}
