<?php

header('Content-tyoe: text/html; charset=utf-8');

// Testando sessões em PHP 

if(isset($_REQUEST ['valor']) and ($_REQUEST['valor']== 'enviado')){
// Cria sessão se usuário tuver clicado no botão enviar do formulário
session_start();
// Cria variáveis de sessão e as inicializa com os dados do formulário:

$_SESSION['nome'] = $_POST ["nome_usuario"];
$_SESSION['cpf'] = $_POST ['cpf_usuario'];

//Exibe link para a página 02: 

echo "<a href='SESSION_BANCO.php'> Continuar Cadastrando </a>";
}
else {
    // Se usuário ainda não clicou no botão de enviar,
    // Mostra o formulário na página: 

?>
<form name="form1" action="SESSION_CADASTRO.php?valor=enviado" method="POST">
    <p> Digite seu nome: <br><input type="text" name="nome_usuario"><br>    
    <p> Digite seu CPF: <br><input type="text" placeholder="000.000.000-00" name="cpf_usuario" maxlength="14"><br>
    <br>
    <input type="submit" value="Enviar">
    </p>
    </form>
    <?php
}
?>
