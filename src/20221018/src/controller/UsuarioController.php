<?php

namespace App\Model;

require_once 'model/Usuario.php';

class UsuarioController{
    public function exibir(){
        $usuario = new Usuario();

        $_REQUEST['usuarios'] =  $usuario->ler();

        require_once 'view/usuario_view.php';
    }
}