<?php
error_reporting(E_ERROR | E_PARSE);
date_default_timezone_set('America/Campo_Grande');

include_once("connection.php");

if($_SERVER["REQUEST_METHOD"]==="POST"){
    if(isset($_POST["rgm"])){
        $rgm = $_POST["rgm"];


        $query = "UPDATE usuarios SET modified='".date(DATE_ATOM)."'";
        if(isset($_POST["nome"])){
            $query .= ", nome='".$_POST["nome"]."'";
        }
        if(isset($_POST["usuario"])){
            $query .= ", usuario='".$_POST["usuario"]."'";
        }
        if(isset($_POST["senha"])){
            $query .= ", senha='".$_POST["senha"]."'";
        }
        $query.= " WHERE rgm='".$rgm."'";

        $result = pg_query($query);

        if($result && pg_affected_rows($result) > 0){
            echo json_encode("{'message':'usuario atualizado'}");
            exit();
        }
    }
}

http_response_code(400);