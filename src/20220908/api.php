<?php

include_once("connection.php");

$query = "SELECT id, nome, usuario FROM usuarios";
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

echo "<table>";
$first = true;
while($line = pg_fetch_array($result, null, PGSQL_ASSOC)){
    if($first){
        echo "<tr>";
        foreach ($line as $key => $value) {
            echo "<th>".$key."</th>";
        }
        echo "</tr>";
        $first = false;
    }
    echo "<tr>";
    foreach ($line as $key => $value) {
        echo "<td>".$value."</td>";
    }
    echo "</tr>";
}
echo "</table>";