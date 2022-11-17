<?php

if($_SERVER["REQUEST_METHOD"]==="GET"){
    if(isset($_GET["nome"])&&isset($_GET["idade"])){
        echo "<h1>".$_GET["nome"]."</h1>";
        $idade = $_GET["idade"];
        if($idade<16){
            echo "<h3>Você não pode votar!</h3>";
        }else if($idade<18 || $idade>69){
            echo "<h3>Você pode votar mas não é obrigado!</h3>";
        }else{
            echo "<h3>Você é obrigado a votar!</h3>";
        }
        exit();
    }
}

http_response_code(400);