<?php

namespace App\Contracts;

interface PedidoServiceInterface extends ServiceInterface
{
    public function cancel($id);
}
