<?php

include_once("connection.php");

$query = "SELECT id, nome, usuario FROM usuarios";
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

$users = Array();

while($line = pg_fetch_array($result, null, PGSQL_ASSOC)){
    array_push($users,$line);
}

echo json_encode($users);