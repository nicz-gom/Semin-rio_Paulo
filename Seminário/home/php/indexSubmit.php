<?php
session_start();
include '../../database/database.php';

$erros = [];

if($_SERVER['REQUEST_METHOD'] == 'POST'){ //verificando se o método é post
    $nomeEnvio = $_POST['nome'];
    $senhaEnvia = $_POST['senha'];

    if(empty($nomeEnvio) || empty($senhaEnvia)){ //verificando se está vazio
        $erros[] = 'Preencha os campos acima!';
        header("Location: ../index.php");
        exit;
    }
    

    $busca = $pdo->prepare('SELECT* FROM tbuser WHERE nome=:nome'); //preparando sql query, para envitar sql injection

    $busca->execute([ //executa o query que foi solicitado no código acima
        ':nome' => $nomeEnvio
    ]);

    if(!$busca){ //validando o nome exitente no banco
        $erros[] = "Usuário não encontrado!";
        header("Location: ../index.php");
        exit;
    }
    
    $usuarios = $busca ->fetch(PDO::FETCH_ASSOC);//compilando todos as informações encontradas no usuário
    
    if(!password_verify($senhaEnvia, $usuarios['senha'])){ //validando a senha existente no banco

        $erros[] = "Informações incorretas";
        header("Location: ../index.php");
        exit;
    }else{
        header("Location: ../../add/addProd.php");
        exit;
    }

    if(!empty($erros)){
        $_SESSION['error'] = "$erros";
        header("Location: ../index.php");
        exit;
    }
}else{
    exit;
}