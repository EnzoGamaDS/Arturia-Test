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
    $routes->resource('carrinho', ['controller' => 'CarrinhoController']);
    $routes->post('carrinho/finalizar', 'CarrinhoController::finalizar');
    
    // Adicionando rota PUT explícita para cancelar pedidos antes das rotas RESTful padrão
    $routes->put('pedidos/cancelar/(:num)', 'PedidoController::cancel/$1');

    // Definindo rota PUT para atualização explícita (opcional)
    $routes->put('pedidos/(:num)', 'PedidoController::update/$1');
});
