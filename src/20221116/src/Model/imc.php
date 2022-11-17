<?php
    namespace App\Model;

    class IMC{
        private $altura;
        private $peso;

        function __construct($altura = null, $peso = null){
            $this->altura = $altura;
            $this->peso = $peso;
        }

        public function setAltura($altura){
            $this->altura = $altura;
        }

        public function getAltura(){
            return $this->altura;
        }

        public function setPeso($peso){
            $this->peso = $peso;
        }

        public function getPeso(){
            return $this->peso;
        }

        public function getIMC(){
            if (is_null($this->getAltura()) || is_null($this->getPeso()) || $this->altura <= 0 || $this->peso <= 0) return null;

            return $this->peso / ($this->altura * $this->altura);
        }

        public function getClassificacao(){
            if (is_null($this->getIMC())) return null;

            if ($this->getIMC() < 18.5){
                return 'MAGREZA';
            }
            else if($this->getIMC() <=24.9){
                return 'NORMAL';
            }
            else if($this->getIMC() <= 29.9){
                return 'SOBREPESO';
            }
            else if($this->getIMC() <= 39.9){
                return 'OBESIDADE';
            }
            else{
                return 'OBESIDADE GRAVE';
            }
        }

        public function getGrau(){
            if (is_null($this->getIMC())) return null;

            if($this->getClassificacao() == 'SOBREPESO'){
                return 1;
            }
            else if($this->getClassificacao() == 'OBESIDADE'){
                return 2;
            }
            else if ($this->getClassificacao() == 'OBESIDADE GRAVE'){
                return 3;
            }
            else{
                return 0;
            }
        }
    }