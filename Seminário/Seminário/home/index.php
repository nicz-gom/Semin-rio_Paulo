<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Index</title>
</head>
<body>
    <form action="php/indexSubmit.php" method="post">
        <img src="../img/produtos.png">
        <input type="text" name="nome" placeholder="Nome:" required>
        <input type="password" name="senha" placeholder="Senha:" required>
        <button>Entrar</button>
        <p>Não tem uma conta?</p><a href="register.php">Cadastrar-se</a>
    </form>
</body>
</html>