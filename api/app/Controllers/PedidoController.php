<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use Config\Services;

class PedidoController extends ResourceController
{
    protected $service;

    public function __construct()
    {
        $this->service = Services::pedidoService();
    }

    public function index()
    {
        try {
            $pedidos = $this->service->getAll();
            return $this->respond($pedidos);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }

    public function show($id = null)
    {
        try {
            $pedido = $this->service->getById($id);
            if ($pedido) {
                return $this->respond($pedido);
            } else {
                return $this->failNotFound('Pedido não encontrado.');
            }
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }

    public function create()
    {
        try {
            $data = $this->request->getJSON(true);
            $pedido = $this->service->create($data);
            return $this->respondCreated($pedido);
        } catch (\Exception $e) {
            return $this->failValidationError($e->getMessage());
        }
    }

    public function update($id = null)
    {
        try {
            $data = $this->request->getRawInput();
            $pedido = $this->service->update($id, $data);
            return $this->respond($pedido);
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

    public function cancel($id = null)
    {
        try {
            $result = $this->service->cancel($id);
            return $this->respondDeleted($result);
        } catch (\Exception $e) {
            return $this->fail($e->getMessage());
        }
    }
}
