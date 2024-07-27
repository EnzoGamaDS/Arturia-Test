<?php

namespace Config;

use CodeIgniter\Config\BaseService;
use App\Services\UsuarioService;
use App\Services\ProdutoService;
use App\Services\PedidoService;
use App\Repositories\UsuarioRepository;
use App\Repositories\ProdutoRepository;
use App\Repositories\PedidoRepository;

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

        return new ProdutoService(new ProdutoRepository());
    }

    public static function pedidoService($getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('pedidoService');
        }

        return new PedidoService(new PedidoRepository());
    }
}
