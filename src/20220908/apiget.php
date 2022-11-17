<?php
error_reporting(E_ERROR | E_PARSE);

include_once("connection.php");

if($_SERVER["REQUEST_METHOD"]==="GET"){
    $tabela = isset($_GET["tabela"]) ? filter_input(INPUT_GET,"tabela",FILTER_SANITIZE_SPECIAL_CHARS) : false;
    $coluna = isset($_GET["coluna"]) ? filter_input(INPUT_GET,"coluna",FILTER_SANITIZE_SPECIAL_CHARS) : false;
    $valor = isset($_GET["valor"]) ? filter_input(INPUT_GET,"valor",FILTER_SANITIZE_SPECIAL_CHARS) : false;
}

if(!$tabela){
    $arr["erro"]=true;
    $arr["msg"]=pg_last_error();
    echo json_encode($arr);
    die();
}

$sql = "SELECT * FROM $tabela ";
$sql .= $coluna && $valor ? "WHERE $coluna='$valor'" : "";

$result = pg_query($sql);

if(!$result){
    $arr["erro"]=true;
    $arr["msg"]=pg_last_error();
    echo json_encode($arr);
    die();
}

$arr["erro"] = false;
$arr["resultado"] = Array();

while($line = pg_fetch_array($result, null, PGSQL_ASSOC)){
    array_push($arr["resultado"],$line);
}

echo json_encode($arr);

