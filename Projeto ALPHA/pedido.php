<?php
session_start();
include "conexao.php";

if(!isset($_SESSION['id_usuario'])){
    header("location:index.php");
}

$capital = $_SESSION['capital'];
$total = $_SESSION['total'];
$rendimento = $total - $capital;

if(isset($_POST['registrar'])){

    $Comando = $conexao->prepare(
        "INSERT INTO TB_PEDIDO
        (
            ID_USUARIO,
            BANCO_PEDIDO,
            CONTA_PEDIDO,
            CAPITAL_PEDIDO,
            TAXA_PEDIDO,
            TEMPO_PEDIDO,
            RENDIMENTO_PEDIDO,
            TOTAL_PEDIDO
        )
        VALUES
        (?, ?, ?, ?, ?, ?, ?, ?)"
    );

    $Comando->bindParam(1, $_SESSION['id_usuario']);
    $Comando->bindParam(2, $_SESSION['banco']);
    $Comando->bindParam(3, $_SESSION['conta']);
    $Comando->bindParam(4, $capital);
    $Comando->bindParam(5, $_SESSION['taxa']);
    $Comando->bindParam(6, $_SESSION['tempo']);
    $Comando->bindParam(7, $rendimento);
    $Comando->bindParam(8, $total);

    if($Comando->execute()){

        header("location:confirmar_pedido.php");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Pedido</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

<h2>PEDIDO</h2>

<p><b>Nome:</b> <?php echo $_SESSION['nome']; ?></p>

<p><b>CPF:</b> <?php echo $_SESSION['cpf']; ?></p>

<p><b>Email:</b> <?php echo $_SESSION['email']; ?></p>

<p><b>Banco:</b> <?php echo $_SESSION['banco']; ?></p>

<p><b>Conta:</b> <?php echo $_SESSION['conta']; ?></p>

<p><b>Capital:</b> R$ <?php echo number_format($capital,2,',','.'); ?></p>

<p><b>Rendimento:</b> R$ <?php echo number_format($rendimento,2,',','.'); ?></p>

<p><b>Total:</b> R$ <?php echo number_format($total,2,',','.'); ?></p>

<form method="POST">

<button type="submit" name="registrar">
REGISTRAR PEDIDO
</button>

</form>

</div>

</body>
</html>
