<?php
session_start();

if(!isset($_SESSION['id_usuario'])){
    header("location:index.php");
}

if(isset($_POST['enviar'])){

    $_SESSION['banco'] = $_POST['banco'];
    $_SESSION['conta'] = $_POST['conta'];
    $_SESSION['capital'] = $_POST['capital'];
    $_SESSION['taxa'] = $_POST['taxa'];
    $_SESSION['tempo'] = $_POST['tempo'];

    $capital = $_POST['capital'];
    $taxa = ($_POST['taxa'] / 100) + 1;
    $tempo = $_POST['tempo'];

    $total = $capital * pow($taxa, $tempo);

    $_SESSION['total'] = $total;

    header("location:pedido.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Banco</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

<h2>BANCO</h2>

<form method="POST">

<select name="banco">
<option>Banco do Brasil</option>
<option>Caixa</option>
<option>Itaú</option>
<option>Santander</option>
</select>

<input type="text" name="conta" placeholder="Conta" required>

<input type="number" step="0.01" name="capital" placeholder="Capital" required>

<input type="number" step="0.01" name="taxa" placeholder="Taxa" required>

<input type="number" name="tempo" placeholder="Tempo em meses" required>

<button type="submit" name="enviar">ENVIAR</button>

</form>

</div>

</body>
</html>