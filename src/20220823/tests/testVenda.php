<?php

    namespace Tests;

    use PHPUnit\Framework\TestCase;
    use App\Model\Venda;

    class VendaTest extends TestCase{
        public function testFreteGratis(){
            $venda = new Venda();
            $this->assertTrue($venda->freteGratis(150));
            $this->assertTrue($venda->freteGratis(151));
            $this->assertFalse($venda->freteGratis(149));
        }
        public function testGetNomeVendedor(){
            $venda = new Venda();
            $vendedor = "Felipe";
            $venda->setVendedor($vendedor);
            $this->assertEquals($vendedor,$venda->getVendedor());
        }
    }

