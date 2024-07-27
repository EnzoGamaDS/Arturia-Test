<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Services\UsuarioService;
use Config\Services;

class UsuarioController extends ResourceController
{
    protected $service;

    public function __construct()
    {
        $this->service = Services::usuarioService();
    }

    public function index()
    {
        try {
            $usuarios = $this->service->getAll();
            return $this->respond($usuarios);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }

    public function show($id = null)
    {
        try {
            $usuario = $this->service->getById($id);
            if ($usuario) {
                return $this->respond($usuario);
            } else {
                return $this->failNotFound('Usuário não encontrado.');
            }
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }

    public function create()
    {
        try {
            $data = $this->request->getJSON(true);
            $usuario = $this->service->create($data);
            return $this->respondCreated($usuario);
        } catch (\Exception $e) {
            return $this->failValidationError($e->getMessage());
        }
    }

    public function update($id = null)
    {
        try {
            $data = $this->request->getRawInput();
            $usuario = $this->service->update($id, $data);
            return $this->respond($usuario);
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
