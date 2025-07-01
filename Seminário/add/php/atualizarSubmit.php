<?php
session_start();
include '../../database/database.php';
include 'Produto.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'] ?? null;
    $nome = $_POST['nome'] ?? '';
    $preco = $_POST['preco'] ?? '';
    
    // Validações
    $erros = [];
    
    if (empty($id) || !is_numeric($id)) {
        $erros[] = "ID do produto inválido";
    }
    
    if (empty($nome)) {
        $erros[] = "Nome é obrigatório";
    }
    
    if (!is_numeric($preco) || $preco < 0) {
        $erros[] = "Preço deve ser um número positivo";
    }
    
    if (empty($erros)) {
        try {
            $produto = new Produto($pdo);
            $sucesso = $produto->atualizar($id, $nome, $preco);
            
            if ($sucesso) {
                $_SESSION['sucesso'] = "Produto atualizado com sucesso!";
            } else {
                $_SESSION['erro'] = "Falha ao atualizar produto";
            }
        } catch (PDOExeption $e) {
            $_SESSION['erro'] = "Erro: " . $e->getMessage();
        }
    } else {
        $_SESSION['erro'] = implode("<br>", $erros);
    }
    
    header("Location: ../addProd.php");
    exit;
} else {
    $_SESSION['erro'] = "Método inválido";
    header("Location: ../addProd.php");
    exit;
}