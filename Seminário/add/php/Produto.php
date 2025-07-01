<?php 
class Produto {
    private $nome;
    private $preco;
    private $pdo;

    // Construtor opcional com nome e preço
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    
    // Setters
    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setPreco($preco) {
        $this->preco = $preco;
    }

    // Getters
    public function getNome() {
        return $this->nome;
    }

    public function getPreco() {
        return $this->preco;
    }

    // Inserir produto no banco
    public function novoProduto() {
        if (empty($this->nome) || empty($this->preco)) {
            echo "Nome e preço são obrigatórios.";
            return false;
        }

        try {
            $novoProduto = "INSERT INTO tbprod (nome, preco) VALUES (:nome, :preco)";
            $envio = $this->pdo->prepare($novoProduto);

            $envio->execute([
                ':nome' => $this->nome,
                ':preco'=> $this->preco
            ]);
            return true;

        } catch (PDOException $e) {
            echo "Erro ao cadastrar produto: " . $e->getMessage();
            return false;
        }
    }
}
