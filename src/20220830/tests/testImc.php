<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Model\Imc;

class ImcTest extends TestCase
{
    public function testGetImc()
    {
        $peso = 85;
        $altura = 1.75;
        $imc = new Imc($altura, $peso);

        $this->assertEquals($peso / ($altura * $altura), $imc->getImc());
    }

    public function testGetPesoAltura()
    {
        $imc = new Imc();
        $this->assertEquals($imc->getPeso(), 0);
        $this->assertEquals($imc->getAltura(), 0);
    }

    public function testGetClassificacao()
    {
        $imc = new Imc();
        $this->assertFalse($imc->getClassificacao());

        //Quando o IMC < 18,5
        $imc->setAltura(1.95);
        $imc->setPeso(70.34);
        $this->assertEquals("Magreza", $imc->getClassificacao());
        //Quando o IMC >= 18,5 e < 25
        $imc->setAltura(1.95);
        $imc->setPeso(70.35);
        $this->assertEquals("Normal", $imc->getClassificacao());
        $imc->setAltura(1.95);
        $imc->setPeso(95.05);
        $this->assertEquals("Normal", $imc->getClassificacao());
        //Quando o IMC >= 25 e < 30
        $imc->setAltura(1.95);
        $imc->setPeso(95.1);
        $this->assertEquals("Sobrepeso", $imc->getClassificacao());
        $imc->setAltura(1.95);
        $imc->setPeso(114.05);
        $this->assertEquals("Sobrepeso", $imc->getClassificacao());
        //Quando o IMC >= 30 e < 35
        $imc->setAltura(1.95);
        $imc->setPeso(114.1);
        $this->assertEquals("Obesidade I", $imc->getClassificacao());
        $imc->setAltura(1.95);
        $imc->setPeso(133.05);
        $this->assertEquals("Obesidade I", $imc->getClassificacao());
        //Quando o IMC >= 35 e < 40
        $imc->setAltura(1.95);
        $imc->setPeso(133.1);
        $this->assertEquals("Obesidade II", $imc->getClassificacao());
        $imc->setAltura(1.95);
        $imc->setPeso(152.05);
        $this->assertEquals("Obesidade II", $imc->getClassificacao());
        //Quando o IMC >= 40
        $imc->setAltura(1.95);
        $imc->setPeso(152.1);
        $this->assertEquals("Obesidade III", $imc->getClassificacao());
    }
}
