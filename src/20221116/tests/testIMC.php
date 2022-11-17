<?php

    namespace Tests;

    use PHPUnit\Framework\TestCase;
    use App\Model\IMC;

    class IMCTest extends TestCase{
        public function testGetPeso(){
            $imc = new IMC();
            $peso = 80;
            $this->assertTrue(is_null($imc->getPeso()));
            $imc->setPeso($peso);
            $this->assertEquals($imc->getPeso(), $peso);
        }

        public function testGetAltura(){
            $imc = new IMC();
            $altura = null;
            $this->assertEquals($imc->getAltura(), $altura);
            $altura = 1.83;
            $imc->setAltura(1.83);
            $this->assertEquals($imc->getAltura(), $altura);
        }

        public function testGetIMC(){
            $imc = new IMC();
            $this->assertTrue(is_null($imc->getIMC()));
            $altura = 1.83;
            $peso = 80;
            $imc->setPeso($peso);
            $imc->setAltura($altura);
            $this->assertEquals($peso/($altura * $altura), $imc->getIMC());
            $imc = new IMC($altura, $peso);
        }

        public function testGetClassificacao(){
            $imc = new IMC();

            $this->assertTrue(is_null($imc->getClassificacao()));

            $altura = 1;
            $peso = 1;
            $imc->setAltura($altura);
            $imc->setPeso($peso);
            $this->assertEquals($imc->getClassificacao(), 'MAGREZA');

            $altura = 1.90;
            $peso = 100;
            $imc->setAltura($altura);
            $imc->setPeso($peso);
            $this->assertEquals($imc->getClassificacao(), 'SOBREPESO');
            
            
            $altura = 1.63;
            $peso = 100;
            $imc->setAltura($altura);
            $imc->setPeso($peso);
            $this->assertEquals($imc->getClassificacao(), 'OBESIDADE');

            $altura = 1.80;
            $peso = 130;
            $imc->setAltura($altura);
            $imc->setPeso($peso);
            $this->assertEquals($imc->getClassificacao(), 'OBESIDADE GRAVE');
        }

        public function testeGetGrau(){
            $imc = new IMC();
            $altura = 0;
            $peso = 0;
            $this->assertTrue(is_null($imc->getGrau()));

            $imc->setAltura($altura);
            $imc->setPeso($peso);
            $this->assertTrue(is_null($imc->getGrau()));

            $altura = 1;
            $peso = 1;
            $imc->setPeso($peso);
            $imc->setAltura($altura);
            $this->assertEquals($imc->getGrau(), 0);

            $altura = 1.90;
            $peso = 100;
            $imc->setPeso($peso);
            $imc->setAltura($altura);
            $this->assertEquals($imc->getGrau(), 1);

            $altura = 1.70;
            $peso = 90;
            $imc->setPeso($peso);
            $imc->setAltura($altura);
            $this->assertEquals($imc->getGrau(), 2);

            $altura = 1.80;
            $peso = 130;
            $imc->setPeso($peso);
            $imc->setAltura($altura);
            $this->assertEquals($imc->getGrau(), 3);
        }

    }


