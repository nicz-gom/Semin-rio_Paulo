<?php 
session_start();
include '../../database/database.php';

$busca = $pdo->prepare('SELECT * FROM tbprod');
$produtos = $busca->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleProd.css">
    <title>Index</title>
</head>
<body>
    <form action="php/cadastrarSubmit.php" method="post">
        <div id="dadosProd">
            <h1>Cadastrar Produtos</h1>
            <input type="text" name="nome" placeholder="Nome:" required>
            <input type="number" name="preco" placeholder="Preço:" step="01"  required>
        </div>
        <div id="addProd">
            <img src="../img/produtos.png">
            <button type="submit" ><img src="../img/mais.png"></button>
        </div>
    </form>
    <section>
        <div>
            <?php foreach($produtos as $produto):?>
            <table>
                <tr>
                    <td><?= htmlspecialchars($produto['nome'])?><td>
                    <td><?= htmlspecialchars($produto['preco'])?><td>
                    <td><button><img src="/img/marca-x.png" ></button></td>
                    <td><button><img src="/img/mais" ></button></td>
                </tr>
            </table>
           <?php endforeach; ?> 
        </div>
    </section>
</body>
</html>