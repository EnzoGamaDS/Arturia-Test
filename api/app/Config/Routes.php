<?php

namespace Config;

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes = Services::routes();
$routes->get('/', 'Home::index');

$routes->group('api', ['namespace' => 'App\Controllers'], function($routes) {
    $routes->resource('usuarios', ['controller' => 'UsuarioController']);
    $routes->resource('produtos', ['controller' => 'ProdutoController']);
    $routes->resource('pedidos', ['controller' => 'PedidoController']);
    $routes->put('cancelar/(:num)', 'PedidoController::cancel/$1');


});
