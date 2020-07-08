<?php
    $server = "localhost";
    $user = "root";
    $pass = "root";
    $banco = "matheasy";

    //Criar a conexão com o BD
    $conexao = mysqli_connect($server, $user, $pass, $banco);
    if(!$conexao) {
        die("Problema com a conexão com o Banco de Dados");
    }
    else {
        //Abrir o banco de dados
        mysqli_select_db($conexao, $banco);
    }
?>