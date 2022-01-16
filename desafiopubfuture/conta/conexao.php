<?php

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "financeiro";
$port = 3306;

try{
    $conn = new PDO("mysql:host=$host;port=$port;dbname=" . $dbname, $user, $pass);
}  catch(PDOException $err){
    echo "Erro: Conexão não foi realizada com sucesso. " . $err->getMessage();
}


