<?php
//Ligar base de dados
    $server = 'localhost';
    $user = 'root';
    $pass = '';
    $database = 'felixbus';

    $conn = mysqli_connect($server, $user, $pass, $database) or die("Erro ao ligar a base de dados");
?>