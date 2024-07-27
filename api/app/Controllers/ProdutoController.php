<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class ProdutoController extends ResourceController
{
    protected $modelName = 'App\Models\ProdutoModel';
    protected $format    = 'json';

    public function index()
    {
        $produtos = $this->model->findAll();
        return $this->respond($produtos);
    }

    public function show($id = null)
    {
        $produto = $this->model->find($id);
        if ($produto) {
            return $this->respond($produto);
        }
        return $this->failNotFound('Produto não encontrado');
    }

    public function create()
    {
        $data = $this->request->getPost();
        if ($this->model->insert($data)) {
            return $this->respondCreated($data);
        } else {
            return $this->failValidationError($this->model->errors());
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
            return $this->respondDeleted('Produto excluído');
        } else {
            return $this->failNotFound('Produto não encontrado');
        }
    }
}
