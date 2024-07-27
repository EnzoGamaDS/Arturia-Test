<?php

namespace Config;

use App\Controllers\UsuarioController;
use App\Controllers\ProdutoController;
use App\Controllers\PedidoController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes = Services::routes();
$routes->get('/', 'Home::index');

$routes->group('api', function($routes) {
    // Rotas de Usuários
    $routes->get('usuarios', 'UsuarioController::index');
    $routes->get('usuarios/(:segment)', 'UsuarioController::show/$1');
    $routes->post('usuarios', 'UsuarioController::create');
    $routes->put('usuarios/(:segment)', 'UsuarioController::update/$1');
    $routes->delete('usuarios/(:segment)', 'UsuarioController::delete/$1');

    // Rotas de Produtos
    $routes->get('produtos', 'ProdutoController::index');
    $routes->get('produtos/(:segment)', 'ProdutoController::show/$1');
    $routes->post('produtos', 'ProdutoController::create');
    $routes->put('produtos/(:segment)', 'ProdutoController::update/$1');
    $routes->delete('produtos/(:segment)', 'ProdutoController::delete/$1');

    // Rotas de Pedidos
    $routes->get('pedidos', 'PedidoController::index');
    $routes->get('pedidos/(:segment)', 'PedidoController::show/$1');
    $routes->post('pedidos', 'PedidoController::create');
    $routes->put('pedidos/(:segment)', 'PedidoController::update/$1');
    $routes->delete('pedidos/(:segment)', 'PedidoController::delete/$1');
    $routes->put('pedidos/finalizar/(:segment)', 'PedidoController::finalizar/$1');
});
