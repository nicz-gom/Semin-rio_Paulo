<?php
session_start();
include '../../database/database.php';
include 'Produto.php';

$nome = $_POST['nome'] ?? '';
$preco = $_POST['preco'] ?? '';
$erros = [];

if (empty($nome) || empty($preco)) {
    $erros[] = "Preencha todos os campos!";
} elseif (!is_numeric($preco)) {
    $erros[] = "O preço deve ser um número!";
}

if (!empty($erros)) {
    $_SESSION['error'] = $erros;
    header("Location: ../addProd.php");
    exit;
}

$produto = new Produto($pdo);

if ($produto->criar($nome, $preco)) {
    $_SESSION['success'] = "Produto cadastrado com sucesso!";
} else {
    $_SESSION['error'] = ["Erro ao cadastrar produto!"];
}

header("Location: ../addProd.php");
exit;
