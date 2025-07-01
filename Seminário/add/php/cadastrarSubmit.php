<?php
session_start();
include '../../database/database.php';
include 'Produto.php';

$erros = [];

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nomeProd = $_POST['nome'];
    $precoProd = $_POST['preco'];

    if(empty($nomeProd) || empty($precoProd)){
        $erros [] = 'Preencha os campos acima!';
    }

    if(!is_numeric($precoProd)){
        $erros [] = 'Somente número!';
    }

    if(!empty($erros)){
         $_SESSION['error'] = "$erros";
         header("Location: ../register.php");
         exit;
    }

    $produto = new Produto($pdo);
    $produto->setNome($nomeProd);
    $produto->setPreco($precoProd);
    if ($produto->novoProduto()) {
        echo "Produto inserido com sucesso!";
    } else {
        echo "Erro ao inserir produto.";
    }
    header("Location: ../addProd.php");
    exit;
}