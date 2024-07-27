<?php

namespace Config;

use CodeIgniter\Config\BaseService;
use App\Services\UsuarioService;
use App\Repositories\UsuarioRepository;

class Services extends BaseService
{
    public static function usuarioService($getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('usuarioService');
        }

        return new UsuarioService(new UsuarioRepository());
    }
}
