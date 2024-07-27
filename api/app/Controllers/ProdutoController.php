<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use Config\Services;

class ProdutoController extends ResourceController
{
    protected $service;

    public function __construct()
    {
        $this->service = Services::produtoService();
    }

    public function index()
    {
        try {
            $produtos = $this->service->getAll();
            return $this->respond($produtos);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }

    public function show($id = null)
    {
        try {
            $produto = $this->service->getById($id);
            if ($produto) {
                return $this->respond($produto);
            } else {
                return $this->failNotFound('Produto não encontrado.');
            }
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }

    public function create()
    {
        try {
            $data = $this->request->getJSON(true);
            $produto = $this->service->create($data);
            return $this->respondCreated($produto);
        } catch (\Exception $e) {
            return $this->failValidationError($e->getMessage());
        }
    }

    public function update($id = null)
    {
        try {
            $data = $this->request->getRawInput();
            $produto = $this->service->update($id, $data);
            return $this->respond($produto);
        } catch (\Exception $e) {
            return $this->failValidationError($e->getMessage());
        }
    }

    public function delete($id = null)
    {
        try {
            $this->service->delete($id);
            return $this->respondDeleted(['id' => $id]);
        } catch (\Exception $e) {
            return $this->failNotFound($e->getMessage());
        }
    }
}
