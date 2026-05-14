<?php
session_start();
include "conexao.php";

$modoRecuperacao = false;

if(isset($_GET['token'])){

    $token = $_GET['token'];

    $Comando = $conexao->prepare(
        "SELECT * FROM TB_USUARIO
        WHERE TOKEN_RECUPERACAO=?"
    );

    $Comando->bindParam(1, $token);
    $Comando->execute();

    if($Comando->rowCount() > 0){

        $Usuario = $Comando->fetch(PDO::FETCH_OBJ);

        $modoRecuperacao = true;
    }
}

if(isset($_POST['cadastrar'])){

    $senha = $_POST['senha'];
    $confirmar = $_POST['confirmar'];

    if($senha != $confirmar){

        echo "<script>
        alert('Senhas não conferem');
        </script>";
    }

    else{

        if($modoRecuperacao){

            $Update = $conexao->prepare(
                "UPDATE TB_USUARIO
                SET
                SENHA_USUARIO=?,
                TOKEN_RECUPERACAO=NULL
                WHERE ID_USUARIO=?"
            );

            $Update->bindParam(1, $senha);
            $Update->bindParam(2, $Usuario->ID_USUARIO);

            if($Update->execute()){

                echo "<script>
                alert('Senha alterada com sucesso!');
                window.location='index.php';
                </script>";
            }
        }

        else{

            $nome = $_POST['nome'];
            $cpf = $_POST['cpf'];
            $email = $_POST['email'];

            $Comando = $conexao->prepare(
                "INSERT INTO TB_USUARIO
                (
                    NOME_USUARIO,
                    CPF_USUARIO,
                    EMAIL_USUARIO,
                    SENHA_USUARIO
                )
                VALUES
                (?, ?, ?, ?)"
            );

            $Comando->bindParam(1, $nome);
            $Comando->bindParam(2, $cpf);
            $Comando->bindParam(3, $email);
            $Comando->bindParam(4, $senha);

            if($Comando->execute()){

                echo "<script>
                alert('Cadastro realizado com sucesso!');
                window.location='index.php';
                </script>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Cadastro</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

<?php if($modoRecuperacao){ ?>

<h2>ALTERAR SENHA</h2>

<?php } else { ?>

<h2>CADASTRO</h2>

<?php } ?>

<form method="POST">

<?php if(!$modoRecuperacao){ ?>

<input
type="text"
name="nome"
placeholder="Nome"
required>

<input
type="text"
name="cpf"
placeholder="CPF"
required>

<input
type="email"
name="email"
placeholder="Usuário (Email)"
required>

<?php } ?>

<input
type="password"
name="senha"
placeholder="Senha"
required>

<input
type="password"
name="confirmar"
placeholder="Confirmar Senha"
required>

<button type="submit" name="cadastrar">

<?php
if($modoRecuperacao){
    echo "ALTERAR SENHA";
}
else{
    echo "CONFIRMAR DADOS";
}
?>

</button>

</form>

</div>

</body>
</html>