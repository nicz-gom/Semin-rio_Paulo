<?php 
$host = 'localhost';
$db = 'seminario';
$user = 'root';
$password = '';

try{
    //Foi instanciado um novo objeto PDO para a conxão do banco de dados
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $password);
    
    //PDO - é um obj nativo do PHP
    
    //São exces. de erro, se der algum problema, ele irá retornar aqui
    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    echo "Erro na conexão:".$e->getMessage();
}
