<?php
error_reporting(E_ERROR | E_PARSE);

include_once("connection.php");

if($_SERVER["REQUEST_METHOD"]==="GET"){

    $query = "SELECT id, nome, usuario FROM usuarios";
    if(isset($_GET["id"]))
        $query .= " WHERE id='".$_GET["id"]."'";
    $result = pg_query($query) or die('Query failed: ' . pg_last_error());
    
    $users = Array();
    
    while($line = pg_fetch_array($result, null, PGSQL_ASSOC)){
        array_push($users,$line);
    }
    
    echo json_encode($users);

    exit();
}

http_response_code(400);