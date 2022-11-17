<?php

use App\Model\PerguntaController;

    require_once 'controller/PerguntaController.php';

    $pergunta = new PerguntaController();
    $pergunta->exibir();