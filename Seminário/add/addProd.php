<?php 
session_start();
include '../database/database.php';

$busca = $pdo->prepare('SELECT * FROM tbprod');
$busca->execute();
$produtos = $busca->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleProd.css">
    <title>Cadastro Produtos</title>
</head>
<body>
    <form action="php/cadastrarSubmit.php" method="post">
        <div id="dadosProd">
            <h1>Cadastrar Produtos</h1>
            <input type="text" name="nome" placeholder="Nome:" required>
            <input type="number" name="preco" placeholder="Preço:" step="0.01"  required>
        </div>
        <div id="addProd">
            <img src="../img/produtos.png">
            <button type="submit" ><img src="../img/mais.png"></button>
        </div>
    </form>
    <section>
        <div>
            <?php if($produtos): ?>
                <?php foreach($produtos as $produto):?>
                <table style="width: 100%;">
                    <tr style="width: 100%;">
                        <td style="text-align: start; width: 40%;"><?= htmlspecialchars($produto['nome'])?></td>
                        <td style="text-align: center; width: 40%;"><?= htmlspecialchars($produto['preco'])?></td>
                        <td style="width: 22.22px;"><button><img height="20px" src="../img/marca-x.png" ></button></td>
                        <td style="width: 22.22px;" ><button><img height="20px" src="../img/editar.png" ></button></td>
                    </tr>
                </table>
            <?php endforeach; ?>
           <?php endif; ?>
        </div>
    </section>
</body>
</html>