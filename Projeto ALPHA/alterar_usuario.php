<?php
session_start();
include "conexao.php";

$id = $_SESSION['id_usuario'];

if(isset($_POST['alterar'])){

    $nome = $_POST['nome'];
    $email = $_POST['email'];

    $Comando = $conexao->prepare(
        "UPDATE TB_USUARIO
        SET
        NOME_USUARIO=?,
        EMAIL_USUARIO=?
        WHERE ID_USUARIO=?"
    );

    $Comando->bindParam(1, $nome);
    $Comando->bindParam(2, $email);
    $Comando->bindParam(3, $id);

    if($Comando->execute()){

        $_SESSION['nome'] = $nome;
        $_SESSION['email'] = $email;

        echo "<script>alert('Dados alterados')</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Alterar</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

<h2>ALTERAR USUÁRIO</h2>

<form method="POST">

<input type="text"
name="nome"
value="<?php echo $_SESSION['nome']; ?>">

<input type="email"
name="email"
value="<?php echo $_SESSION['email']; ?>">

<button type="submit" name="alterar">
ALTERAR
</button>

</form>

</div>

</body>
</html>
