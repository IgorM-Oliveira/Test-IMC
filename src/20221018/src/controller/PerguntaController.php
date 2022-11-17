<?php

namespace App\Model;

require_once 'model/Pergunta.php';
require_once 'model/Usuario.php';

class PerguntaController {
    public function exibir(){
        $pergunta = new Pergunta();
        $usuario = new Usuario();

        $_REQUEST['perguntas'] = $pergunta->ler();
        $_REQUEST['usuarios'] = $usuario->ler();

        require_once 'view/pergunta_view.php';
    }
}