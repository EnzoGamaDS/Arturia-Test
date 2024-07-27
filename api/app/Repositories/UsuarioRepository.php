<?php

namespace App\Repositories;

use App\Models\UsuarioModel;

class UsuarioRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new UsuarioModel();
    }

    public function getAll()
    {
        return $this->model->findAll();
    }

    public function getById($id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        return $this->model->insert($data);
    }

    public function update($id, array $data)
    {
        return $this->model->update($id, $data);
    }

    public function delete($id)
    {
        return $this->model->delete($id);
    }
}
