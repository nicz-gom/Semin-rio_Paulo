<?php
session_start();
include '../database/database.php';
include 'php/Produto.php';

// Verifica se veio um ID válido
$id = $_GET['id'] ?? null;
if (!$id || !is_numeric($id)) {
    header("Location: index.php?erro=ID inválido");
    exit;
}

// Busca o produto no banco
$produto = new Produto($pdo);
$produtoData = $produto->buscarPorId($id);

// Se não encontrar o produto, redireciona
if (!$produtoData) {
    header("Location: index.php?erro=Produto não encontrado");
    exit;
}

// Mostra mensagens de erro/sucesso se existirem
$mensagemErro = $_GET['erro'] ?? null;
$mensagemSucesso = $_GET['sucesso'] ?? null;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleProd.css">
    <title>Editar Produto</title>
</head>
<body>
    <!-- Mensagens de feedback -->
    <?php if ($mensagemErro): ?>
        <div class="mensagem erro"><?= htmlspecialchars($mensagemErro) ?></div>
    <?php endif; ?>
    
    <?php if ($mensagemSucesso): ?>
        <div class="mensagem sucesso"><?= htmlspecialchars($mensagemSucesso) ?></div>
    <?php endif; ?>

    <!-- Formulário de edição -->
    <form action="php/atualizarSubmit.php" method="POST"> <!-- Alterado para POST -->
        <input type="hidden" name="id" value="<?= $id ?>">
        
        <div id="dadosProd">
            <h1>Editar Produto</h1>
            <input type="text" name="nome" placeholder="Nome:" 
                   value="<?= htmlspecialchars($produtoData['nome']) ?>" required>
                   
            <input type="number" name="preco" placeholder="Preço:" step="0.01"
                   value="<?= htmlspecialchars($produtoData['preco']) ?>" required>
        </div>
        
        <div id="addProd">
            <img src="../img/produtos.png">
            <button type="submit">
                <img src="../img/salve-.png" alt="salvar">
            </button>
            
            <!-- Botão para cancelar/voltar -->
            <a href="addProd.php">
                <img src="../img/cancelar-40novo30.png" alt="Cancelar">
            </a>
        </div>
    </form>
</body>
</html>