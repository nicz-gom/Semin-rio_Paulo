<?php
session_start();
require_once '../../database/database.php';
require_once 'Produto.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    
    if (!$id || $id <= 0) {
        $_SESSION['erro'] = "ID de produto inválido";
        header("Location: ../addProd.php");
        exit;
    }

    try {
        $produto = new Produto($pdo);
        $deletado = $produto->deletar($id);
        
        if ($deletado) {
            $_SESSION['sucesso'] = "Produto excluído com sucesso!";
        } else {
            $_SESSION['erro'] = "Produto não encontrado ou já removido";
        }
    } catch (PDOException $e) {
        $_SESSION['erro'] = "Erro ao excluir produto: " . $e->getMessage();
    }
} else {
    $_SESSION['erro'] = "Método de requisição inválido";
}

header("Location: ../addProd.php");
exit;
?>