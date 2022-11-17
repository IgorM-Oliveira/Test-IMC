<?php

    namespace Tests;

    use PHPUnit\Framework\TestCase;
    use App\Model\Pergunta;

    class PerguntasTest extends TestCase{
        public function testGetQualPergunta(){
            $testPerguntas = new Pergunta();
            $pergunta = "Qual a cor do Céu?";
            $testPerguntas->setPergunta($pergunta);
            $this->assertEquals($testPerguntas->getPergunta(),"Qual a cor do Céu?");
        }


    }
