<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class UsuarioController extends ResourceController
{
    protected $modelName = 'App\Models\UsuarioModel';
    protected $format = 'json';

    public function index()
    {
        return $this->respond($this->model->findAll());
    }

    public function show($id = null)
    {
        $data = $this->model->find($id);
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Usuário não encontrado.');
        }
    }

    public function create()
    {   
        $data = $this->request->getJSON(true);

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
            return $this->respondDeleted(['id' => $id]);
        } else {
            return $this->failNotFound('Usuário não encontrado.');
        }
    }
}
