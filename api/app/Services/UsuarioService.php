<?php

namespace App\Services;

use App\Contracts\UsuarioServiceInterface;
use App\Repositories\UsuarioRepository;

class UsuarioService implements UsuarioServiceInterface
{
    protected $repository;

    public function __construct(UsuarioRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function getById($id)
    {
        return $this->repository->getById($id);
    }

    public function create(array $data)
    {
        if (!$this->repository->create($data)) {
            throw new \Exception('Erro ao criar o usuário.');
        }
        return $data;
    }

    public function update($id, array $data)
    {
        if (!$this->repository->update($id, $data)) {
            throw new \Exception('Erro ao atualizar o usuário.');
        }
        return $data;
    }

    public function delete($id)
    {
        if (!$this->repository->delete($id)) {
            throw new \Exception('Erro ao deletar o usuário.');
        }
        return ['id' => $id];
    }
}
