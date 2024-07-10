<?php

    $hostname = "localhost";
    $usuario = "root";
    $senha = "";
    $bancodedados = "escola";

    // Criando uma nova conexão com o banco de dados
    $mysqli = new mysqli($hostname,$usuario,$senha,$bancodedados);

    // Verificando se houve erro na conexão
    if($mysqli ->connect_errno){
        // Exibindo uma mensagem de erro caso a conexão falhe
        echo "Falha ao conectar : ( ". $mysqli ->connect_errno . ")" . $mysqli->connect_error;
    }

?>
