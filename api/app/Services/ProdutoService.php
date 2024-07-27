<?php

namespace App\Services;

use App\Contracts\ProdutoServiceInterface;
use App\Repositories\ProdutoRepository;

class ProdutoService implements ProdutoServiceInterface
{
    protected $repository;

    public function __construct(ProdutoRepository $repository)
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
        if (isset($data[0]) && is_array($data)) {
            $insertedData = [];
            foreach ($data as $produto) {
                if (!$this->repository->create($produto)) {
                    throw new \Exception('Erro ao criar um dos produtos.');
                }
                $insertedData[] = $produto;
            }
            return $insertedData;
        } else {
            if (!$this->repository->create($data)) {
                throw new \Exception('Erro ao criar o produto.');
            }
            return $data;
        }
    }

    public function update($id, array $data)
    {
        if (!$this->repository->update($id, $data)) {
            throw new \Exception('Erro ao atualizar o produto.');
        }
        return $data;
    }

    public function delete($id)
    {
        if (!$this->repository->delete($id)) {
            throw new \Exception('Erro ao deletar o produto.');
        }
        return ['id' => $id];
    }
}
