<?php 
session_start();
include '../../database/database.php';

$erros = [];
$success = [];

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nomeEnvio = $_POST['nome'];//capitura o input com o name = 'nome'
    $senhaEnvio = $_POST['senha'];

    //verificando se os campos estão vazios
    if(empty($nomeEnvio) || empty($senhaEnvio)){
        $erros [] = 'Preencha os campos acima!';
    }

    //verificando se as senhas não iguais
    if($senhaEnvio != $_POST['confirmacao']){
        $erros [] = 'Senhas não são iguais!';
    }

    //função count serve para contagem de quantidade de letras
    if(strlen($nomeEnvio) < 3){
        $erros [] = 'Nome deve ter mais de 3 caracteres!';
    }

    //validação da senha!
    if(strlen($senhaEnvio) < 3){
        $erros [] = 'Senha deve ter mais de 3 caracteres';
    }

    //Encriptografando a senha para enviar ao banco de dados
    //PASSWORD_DEFAULT - forma padrão de encriptografar
    $senhaEncriptografada = password_hash($senhaEnvio, PASSWORD_DEFAULT);

    //sempre prepara para depois executar
    $novoUsuario = $pdo->prepare('INSERT INTO tbuser (nome, senha) VALUES(:nome, :senha)');

    $novoUsuario->execute([
        ':nome' => $nomeEnvio,
        ':senha' => $senhaEncriptografada
    ]);

    $success[] = "Usuário: $nomeEnvio cadastrado com sucesso!";

    // if(!empty($erros)){
    //     $_SESSION['error'] = "$erros";
    //     header("Location: ../register.php");
    //     exit;
    // }

    header("Location: ../index.php");

    // if(!empty($success)){
    //     $_SESSION['success'] = "$success";
    //     header("Location: ../index.php");
    //     exit;
    // }
}