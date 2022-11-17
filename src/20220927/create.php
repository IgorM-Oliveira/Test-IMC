<?php
error_reporting(E_ERROR | E_PARSE);
date_default_timezone_set('America/Campo_Grande');

include_once("connection.php");

if($_SERVER["REQUEST_METHOD"]==="POST"){
    if(isset($_POST["nome"])&&isset($_POST["rgm"])&&isset($_POST["usuario"])&&isset($_POST["senha"])){
        $nome = $_POST["nome"];
        $rgm = $_POST["rgm"];
        $usuario = $_POST["usuario"];
        $senha = md5(sha1($_POST["senha"]));

        $query = "INSERT INTO usuarios (nome,rgm,usuario,senha,status,tipo,administrador,created,modified) VALUES ('$nome','$rgm','$usuario','$senha','remove_red_eye','person',false,'".date(DATE_ATOM)."','".date(DATE_ATOM)."')";

        $result = pg_query($query);

        if($result){
            echo json_encode("{'message':'usuario inserido'}");
            exit();
        }
    }
}

http_response_code(400);