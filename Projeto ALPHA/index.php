<?php
session_start();
include "conexao.php";

if(isset($_POST['logar'])){

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $Comando = $conexao->prepare(
        "SELECT * FROM TB_USUARIO
        WHERE EMAIL_USUARIO=?
        AND SENHA_USUARIO=?"
    );

    $Comando->bindParam(1, $email);
    $Comando->bindParam(2, $senha);

    $Comando->execute();

    if($Comando->rowCount() > 0){

        $Linha = $Comando->fetch(PDO::FETCH_OBJ);

        $_SESSION['id_usuario'] = $Linha->ID_USUARIO;
        $_SESSION['nome'] = $Linha->NOME_USUARIO;
        $_SESSION['cpf'] = $Linha->CPF_USUARIO;
        $_SESSION['email'] = $Linha->EMAIL_USUARIO;

        header("location:banco.php");

    } else {

        echo "<script>alert('Usuário ou senha inválidos')</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

<h2>LOGIN</h2>

<form method="POST">

<input type="email" name="email" placeholder="Usuário (Email)" required>

<input type="password" name="senha" placeholder="Senha" required>

<button type="submit" name="logar">LOGAR</button>

<br><br>

<a href="cadastro.php">
<button type="button">CADASTRO</button>
</a>

<br><br>

<a href="esqueceu.php">
<button type="button">ESQUECEU A SENHA</button>
</a>

</form>

</div>

</body>
</html>