<?php 
session_start();
include '../database/database.php';
include 'php/Produto.php';

$produto = new Produto($pdo);
$produtos = $produto->listarTodos();
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
            <input type="number" name="preco" placeholder="Preço:" step="0.01" required>
        </div>
        <div id="addProd">
            <img src="../img/produtos.png">
            <button type="submit"><img src="../img/mais.png" alt="Adicionar"></button>
        </div>
    </form>

    <section>
        <div>
            <?php if($produtos): ?>
                <table style="width: 100%;">
                    <?php foreach($produtos as $produto): ?>
                        <tr>
                            <td style="width: 40%; text-align: start;"><?= htmlspecialchars($produto['nome']) ?></td>
                            <td style="width: 40%; text-align: center;">R$ <?= number_format($produto['preco'], 2, ',', '.') ?></td>

                            <!-- Botão de Excluir -->
                            <td style="width: 10%;">
                                <form action="confirmExclusao.php" method="get">
                                    <input type="hidden" name="id" value="<?= $produto['id'] ?>">
                                    <button type="submit"><img src="../img/marca-x.png" height="20px" alt="Excluir"></button>
                                </form>
                            </td>

                            <!-- Botão de Editar -->
                            <td style="width: 10%;">
                                <form action="editProd.php" method="get">
                                    <input type="hidden" name="id" value="<?= $produto['id'] ?>">
                                    <button type="submit"><img src="../img/editar.png" height="20px" alt="Editar"></button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php endif; ?>
        </div>
        <a href="logout.php" 
            style="color: white;margin-top:5px; background: #e74c3c; padding: 0.5rem 1rem; border-radius: 4px; text-decoration: none;">
            Sair
        </a>
    </section>
</body>
</html>
