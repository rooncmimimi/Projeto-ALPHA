<?php
session_start();
include "conexao.php";

$id = $_SESSION['id_usuario'];

$Comando = $conexao->prepare(
    "SELECT * FROM TB_PEDIDO
    WHERE ID_USUARIO=?"
);

$Comando->bindParam(1, $id);
$Comando->execute();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Gerenciar</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

<h2>Pedidos do Usuário</h2>

<table class="tabela">

<tr>
<th>Banco</th>
<th>Capital</th>
<th>Total</th>
</tr>

<?php
while($Linha = $Comando->fetch(PDO::FETCH_OBJ)){
?>

<tr>
<td><?php echo $Linha->BANCO_PEDIDO; ?></td>
<td>R$ <?php echo number_format($Linha->CAPITAL_PEDIDO,2,',','.'); ?></td>
<td>R$ <?php echo number_format($Linha->TOTAL_PEDIDO,2,',','.'); ?></td>
</tr>

<?php
}
?>

</table>

<br>

<a href="alterar_usuario.php">
<button>ALTERAR DADOS</button>
</a>

<br><br>

<a href="logout.php">
<button>SAIR</button>
</a>

</div>

</body>
</html>