<?php
namespace App\model;

class Conexao{
    private static $conexao;

    private function __construct()
    {
        
    }

    public static function getInstancia(){
        if(!isset(self::$conexao)){
            self::$conexao = pg_connect("host=pg-bd dbname=per user=user password=example");
            return self::$conexao;
        }
    }
}