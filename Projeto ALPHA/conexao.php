<?php

define("BANCO", "db_alpha");
define("USUARIO", "root");
define("SENHA", "");

try {

    $conexao = new PDO(
        "mysql:host=localhost;dbname=" . BANCO,
        USUARIO,
        SENHA
    );

    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexao->exec("SET NAMES utf8");

} catch(PDOException $erro) {

    echo "Erro na conexão: " . $erro->getMessage();
}

?>