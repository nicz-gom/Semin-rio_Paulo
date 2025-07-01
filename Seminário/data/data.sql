CREATE DATABASE if not exists seminario; --Criando uma um banco com o nome seminário

-- Foi criado um banco de dados, se ele não existir, o use irá abri-lo.

USE seminario;

CREATE TABLE tbUser(
    --Cria um campo ID que auto incrementa e tem dados únicos
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE tbProd(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    preco DECIMAL(10,2) NOT NULL,
    create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);