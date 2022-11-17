<?php 

include_once("funcao.php");

for($i=0;$i<50;$i++){
    if(par_impar($i))
        echo $i." - é par!<br>";
    else   
        echo $i." - é impar!<br>";
}