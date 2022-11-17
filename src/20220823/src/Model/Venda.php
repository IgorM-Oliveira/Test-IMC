<?php
    namespace App\Model;

    class Venda{
        private $vendedor;

        public function freteGratis($valor){
            return $valor >= 150;
        }

        public function getVendedor(){
            return $this->vendedor;
        }

        public function setVendedor($vendedor){
            $this->vendedor = $vendedor;
        }
    }