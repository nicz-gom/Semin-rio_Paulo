<?php
session_start();
include '../database/database.php';
include 'php/Produto.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    $_SESSION['erro'] = "ID inválido";
    header("Location: addProd.php");
    exit;
}

$produto = new Produto($pdo);
$produtoData = $produto->buscarPorId($id);

if (!$produtoData) {
    $_SESSION['erro'] = "Produto não encontrado";
    header("Location: addProd.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleProd.css">
    <title>Confirmar Exclusão</title>
    <style>
        .confirmacao {
            max-width: 500px;
            margin: 2rem auto;
            padding: 2rem;
            border: 1px solid #ddd;
            border-radius: 8px;
            text-align: center;
            background-color: #ddd;
        }
        .botoes {
            margin-top: 1.5rem;
            display: flex;
            justify-content: center;
            gap: 1rem;
        }
        .btn {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn-confirmar {
            background-color: #ff4444;
            color: white;
        }
        .btn-cancelar {
            background-color: #ccc;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="confirmacao">
        <h2>Confirmar Exclusão</h2>
        <p>Você está prestes a excluir o produto:</p>
        <p><strong><?= htmlspecialchars($produtoData['nome']) ?></strong> - R$ <?= number_format($produtoData['preco'], 2, ',') ?></p>
        
        <div class="botoes">
            <form action="php/destroySubmit.php" method="post">
                <input type="hidden" name="id" value="<?= $id ?>">
                <button type="submit" class="btn btn-confirmar">Confirmar Exclusão</button>
            </form>
            
            <a href="addProd.php" class="btn btn-cancelar">Cancelar</a>
        </div>
    </div>
</body>
</html>