<?php

namespace Config;

use App\Models\ProdutoModel;
use CodeIgniter\Config\BaseService;
use App\Services\UsuarioService;
use App\Services\ProdutoService;
use App\Repositories\UsuarioRepository;
use App\Repositories\ProdutoRepository;

class Services extends BaseService
{
    public static function usuarioService($getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('usuarioService');
        }

        return new UsuarioService(new UsuarioRepository());
    }

    public static function produtoService($getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('produtoService');
        }

        return new ProdutoService(new ProdutoRepository(new ProdutoModel()));
    }
}
