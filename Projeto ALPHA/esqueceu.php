<?php
include "conexao.php";

if(isset($_POST['enviar'])){

    $email = $_POST['email'];

    $Comando = $conexao->prepare(
        "SELECT * FROM TB_USUARIO
        WHERE EMAIL_USUARIO=?"
    );

    $Comando->bindParam(1, $email);
    $Comando->execute();

    if($Comando->rowCount() > 0){

        $token = md5(uniqid(rand(), true));

        $Update = $conexao->prepare(
            "UPDATE TB_USUARIO
            SET TOKEN_RECUPERACAO=?
            WHERE EMAIL_USUARIO=?"
        );

        $Update->bindParam(1, $token);
        $Update->bindParam(2, $email);

        $Update->execute();

        $link = "http://localhost/ProjetoAlpha/cadastro.php?token=$token";

        $mensagem = "
        Clique no link abaixo para alterar sua senha:

        $link
        ";

        $cabecalho = "From: projetoalpha@gmail.com";

        mail($email, "Recuperação de Senha", $mensagem, $cabecalho);

        echo "<script>
        alert('Email enviado!');
        </script>";

    }else{

        echo "<script>
        alert('Email não encontrado!');
        </script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Esqueceu a Senha</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

<h2>RECUPERAR SENHA</h2>

<form method="POST">

<input type="email"
name="email"
placeholder="Digite seu email"
required>

<button type="submit" name="enviar">
ENVIAR EMAIL
</button>

</form>

</div>

</body>
</html>