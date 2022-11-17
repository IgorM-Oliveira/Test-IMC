<?php

$usuarios = array(
    array("usuario"=>"fpz","senha"=>"1234"),
    array("usuario"=>"zpf","senha"=>"1234")
);

if(isset($_POST["usuario"])&&isset($_POST["senha"])){

    $arr = array("usuario"=>$_POST["usuario"],"senha"=>$_POST["senha"]);

    if(in_array($arr,$usuarios)){
        echo "usuario e senha corretos";
    }else{
        echo "usuario e senha incorretos";
    }
}