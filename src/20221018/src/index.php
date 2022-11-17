<?php

use App\Model\UsuarioController;

    require_once 'controller/UsuarioController.php';

    $user = new UsuarioController();
    $user->exibir();