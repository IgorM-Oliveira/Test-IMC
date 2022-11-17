<?php
error_reporting(E_ERROR | E_PARSE);
date_default_timezone_set('America/Campo_Grande');

include_once("connection.php");

if($_SERVER["REQUEST_METHOD"]==="DELETE"){
    if(isset($_REQUEST["rgm"])){
        $rgm = $_REQUEST["rgm"];

        $query = "DELETE FROM usuarios WHERE rgm='".$rgm."'";

        $result = pg_query($query);

        echo pg_result_status($result,PGSQL_STATUS_STRING);

        if($result && pg_affected_rows($result) > 0){
            echo json_encode("{'message':'usuario removido'}");
            exit();
        }
    }
}

http_response_code(400);